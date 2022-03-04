<?php


namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Custom\ModelHelper;
use App\Custom\Utils;

use App\GenericTableModels\control;
use App\GenericTableModels\intrateperiod;
use App\GenericTableModels\language;
use App\GenericTableModels\employee;
use App\GenericTableModels\matter;
use App\GenericTableModels\coldebit;
use App\GenericTableModels\coldata;
use App\GenericTableModels\commissionrate;

/*
Regex search to check casing
colDebit->[A-Z]\w+

Regex to search for incorrect if ( == )
if(.*)(?<!=)=(?!=)(.*)
*/


class DebtorsAccountController extends Controller
{

    function __construct() { 

        $this->debugging = false;

        $this->queue = [];
        $this->interestTransactionsQueue = [];
        $this->dateQueue = [];
        $this->virtualTransactions = [];

        $this->ThisMonthsInterest = 0;
        $this->TotalCapitalBalance = 0;
        $this->InDuplumMaxed = 0;
        $this->InDuplumFlag = 0;
        $this->InterestMaxed = 0;
        $this->FeesMaxed = 0;
        $this->CommissionMaxed = 0;
        $this->FeesLimit = 0;
        $this->CommissionLimit = 0;
        $this->InDuplumOption = '1';
        $this->SavedDate = 0;

        $this->loopCounter = 0;

    } 

    public function getDebtorsAccount($request) {

        try {

            if ( isset($request->debugging) ) $this->debugging = true;

            $startTime = microtime(true);

            /*Testing
			$matterId = 61717;$request = new stdClass();$request->matterid = $matterId; $controller = new \App\Http\Controllers\DebtorsAccountController;$controller->debugging = true;$controller->getDebtorsAccount($request);
            */

            $returnData = new \stdClass();
            $returnData->data = [];



            date_default_timezone_set('Africa/Johannesburg');

            $matterId = isset($request->matterid) ? $request->matterid : $request->matterId;

            if (!isset($matterId)) throw new \Exception('No MatterID specified');

            $this->matter = matter::findOrFail($matterId);            



            $language = language::select('CurrencySymbol')->where('RecordId',$this->matter->DocumentLanguageID)->first();
            $this->currencySymbol = $language->CurrencySymbol;

            $this->colData = coldata::select([
                'CommissionUntilDate',
                'EMOCommissionPercent',
                'EMOEndDate',
                'EMOFirstDate',
                'EMOCommissionPercent',
                'FeesUntilDate',
                'InDuplumOption',
                'InDuplumAmount',
                'IntRateScheduleVariance',
                'InterestEndAmount',
                'MaxFees',
                'MaxCommission',
                'NewInDuplumRuleFlag',
                'NewInDuplumRuleFromDate',
                'OverrideInDuplumSetting',
                'ReceiptPercentToCostsFlag',
                'ReduceCapitalFlag',
            ])
            ->where('MatterID',$matterId)->first();


            if ( !$this->colData ) throw new \Exception("This Matter does not have a Debtors Account.");

            $this->control = control::select([
                'CollCommPercent',
                'CollCommLimit',
                'VatMethod',
                'VatPercent1',
                'VatPercent2',
                'InDuplumOption',
                'SaveColDebitTransactionsFlag',
                'AfrikaansID'
            ])->first();


            if ( !$this->control ) throw new \Exception("An error was encountered getting the Control table.");

            // Get a Collection of the Interest Rate Schedules
            if ( intval($this->matter->IntRateScheduleID) ) {
                $this->intRatePeriods = intrateperiod::where('IntRateScheduleID',$this->matter->IntRateScheduleID)->orderBy('ToDate','asc')->get();
            } else {
                $this->intRatePeriods = collect([]);
            }

            $this->commissionRates = commissionrate::all();

            $employees = employee::select(['RecordID','Name'])->get();

            $this->TotalCapitalBalance = floatval($this->matter->InterestOnAmount) ? $this->matter->InterestOnAmount : $this->matter->DebtorsOpeningBalance;

            $this->InDuplumOption = $this->colData->OverrideInDuplumSetting ? $this->colData->InDuplumOption : $this->control->InDuplumOption;

            if ( $this->control->SaveColDebitTransactionsFlag ) {

                DB::connection('sqlsrv')->statement('DELETE ColDebit WHERE (Type = \'I\' OR Type = \'V\' OR Type = \'X\') AND MatterID = ' . $matterId);

            }


			
			//$colDebitsQuery = coldebit::select <---- Note: This returns a Collection of Models

            // This returns an array of objects (which is what we want)
			$colDebitsQuery = DB::connection('sqlsrv')->table("coldebit")->select([
                'matterid',
                'colcostid',
                'employeeid',
                'date',
                'type',
                'description',
                'interestrate',
                'amount',
                'vatamount',
                'documentcode',
                'documentflag',
                'vatflag',
                'collcommflag',
                'category',
                'interestflag',
                'reference',
                'monthlyinterestflag',
                'balance',
                'costbalance',
                'interestbalance',
                'capitalbalance',
                'timerstamp',
                'batchid',
                'transid',
                'lineid',
                'recordid',
                'exportedflag',
                'origin',
                'employersadminfeeflag',
                'overrideemocommflag',
            ])->where('MatterID',$matterId)
            ->where('Date','>', 0)
            ->whereNotIn('Type', ['V','X','I'])
            ->orderBy('Date')->orderBy('TimerStamp');
            //->orderBy('Date')->orderBy('Type')->orderBy('TimerStamp')->orderBy('RecordID');
            //->orderBy('Date')->orderBy('TimerStamp')->orderBy('Type')->orderBy('RecordID');

            if ( $this->matter->ExcludeDocumentCostsFlag) {
                $colDebitsQuery->whereRaw("(DocumentCode is null OR DocumentCode ='')");
            }

            $colDebits = $colDebitsQuery->get()->toArray();

            $timerStamp = 0;

            foreach ($colDebits as $colDebit) {

                $colDebit->totalamount = $colDebit->amount + $colDebit->vatamount;

                $colDebit->employeename = $employees->find($colDebit->employeeid)->Name;

                // CREATING A QUEUE TO SPEED UP THE PROCESS
                $this->dateQueue[] = $colDebit->date;

                // ADDING PAYMENT OR JOURNAL OR COST (IF INTEREST ON COSTS) TO ITS OWN QUEUE TO SPEED UP THE PROCESS
                if ( $colDebit->type == 'P' || $colDebit->category == 'J' || ($this->matter->InterestOnCostsFlag && $colDebit->type == 'D') ) {
                    $this->interestTransactionsQueue[] = $colDebit;
                }

                if ( $colDebit->type == 'P' || $colDebit->type == 'W' || $colDebit->category == 'J') {

                    // PUT CAPITAL ADJUSTMENTS AT THE END AND ALLOW COLL COMM TO BE JUST AFTER IT
                    $timerStamp += 10;
                    $colDebit->timerstamp = $timerStamp;

                } else if ($colDebit->type == 'J') {

                    $colDebit->timerstamp = 0; //INTEREST AT THE BEGINNING

                } else {

                    $colDebit->timerstamp = 1; // COSTS
                }

                // Add it to the queue
                $this->addColDebit($colDebit);

                //echo "\nAdded: " . Utils::stringFromClarionDate($colDebit->date) . " " . $colDebit->timerstamp . " " . $colDebit->type  . " " . $colDebit->description; 

                if ($colDebit->type == 'P' && $colDebit->category != 'J' ) {
                    
                    if (!$colDebit->overrideemocommflag) {
                        $this->addEmployerCommissionRecord($colDebit);
                    }

                    if ($colDebit->collcommflag) {
                        $this->addCommissionRecord($colDebit);
                    }
                }

            };


            foreach ($this->queue as $key => $value) {

                uasort($this->queue[$key], function($a, $b) { 
                
                    $returnValue = $a->date - $b->date;
                    if ( $returnValue == 0 )$returnValue = $a->timerstamp - $b->timerstamp;
                    return $returnValue;
                    
                });

            }


            if ( $this->debugging ) {

                $x = $this->queue[77158];

                foreach ($x as $colDebit) {
                    echo "\n" .Utils::stringFromClarionDate($colDebit->date) . " " . $colDebit->timerstamp . " " . $colDebit->type . " ". $colDebit->description;
                }
                
                //return;
            }



            //if ( $this->debugging ) echo "\nStart insertInterestTransactions";

            $interestStartTime = microtime(true);

            $this->insertInterestTransactions( );

            $interestEndTime = microtime(true);
            $interestExecutionTime = ($interestEndTime - $interestStartTime);

            //if ( $this->debugging ) echo "\nFinished insertInterestTransactions";


            //Sort date queue by key
            ksort($this->queue);


            if ( $this->debugging ) {
                echo "\n\nProcessing Balances Order.....";

                foreach ($this->queue as $dateArray) {
                    foreach ($dateArray as $colDebit) {
                        echo "\n" .Utils::stringFromClarionDate($colDebit->date) . " " . $colDebit->timerstamp . " " . $colDebit->type . " ". $colDebit->description;
                    }
                }
            }            

            $this->calculateBalances();

            $this->saveVirtualTransactions();

            $tablePosition = 0; // Useful to jump to the correct record after editing

            foreach ($this->queue as $dateArray) {

                foreach ($dateArray as $colDebit) {

                    $this->formatColDebit($colDebit, $tablePosition);

                    $tablePosition++;
                }

            }

            $endTime = microtime(true);
            $totalExecutionTime = ($endTime - $startTime);

            
            if ( $this->debugging ) {
                
                $counter = 0;

                echo "\n\nRESULT\n";

                foreach ($this->queue as $dateArray) {

                    foreach ($dateArray as $colDebit) {
                        $counter++;
                        echo "\n" .Utils::stringFromClarionDate($colDebit->date) . " " . $colDebit->type . " " . $colDebit->timerstamp . "\n" . $colDebit->description  . " " . $colDebit->totalamount; 
                        echo "\n\t\t\t\t\t\t\t\tCosts: " . $colDebit->costbalance . "\tInterest: " . $colDebit->interestbalance . "\tCapital: " . $colDebit->capitalbalance . " Balance: " . $colDebit->balance; 
                    }
                }

                echo "\n\nProcessed " . $counter;
                echo " records in " . number_format($totalExecutionTime,2) . " seconds\n";

                echo "\n" . "Inserting interest took " . number_format($interestExecutionTime,2) . " seconds";
                echo "\n" . "Interest loopCounter = " . $this->loopCounter;
                echo "\n" . "Records in interestTransactionsQueue = " . count($this->interestTransactionsQueue);


                return 'Finished Debugging';

            } else {

                foreach ($this->queue as $dateArray) {

                    foreach ($dateArray as $colDebit) {

                        $returnData->data[] = $colDebit;
                    }

                }

                //$returnData->stats = "Processed " . $counter . " records in " . number_format($totalExecutionTime,2) . " seconds";
                //$returnData->calculation = "Calculating took " . number_format($calculationExecutionTime,2) . " seconds";
                //$returnData->interest = "Inserting interest took " . number_format($interestExecutionTime,2) . " seconds";
                //$returnData->loopCounter = "Interest loopCounter = " . $this->loopCounter;
                //$returnData->interestTransactionsQueue = "Records in interestTransactionsQueue = " . count($this->interestTransactionsQueue);
                //$returnData->saveVirtualTransactions = "saving VirtualTransactions took " . number_format($saveVirtualTransactionsExecutionTime,2) . " seconds";
                //$returnData->formatting = "Formatting took " . number_format($formattingExecutionTime,2) . " seconds";


                //$returnData->data = $this->colDebitQueue;
                return json_encode($returnData);

            }

        } catch(\Exception $e)  {
            
            //$returnData->errors = 'Server Error on line '. $e->getLine() . ' in '. $e->getFile() . '<br><br>' . $e->getMessage();
            $returnData->errors = $e->getMessage();
            return json_encode($returnData);
        }

    }
    
    private function insertInterestTransactions() {

        try {

            $this->InterestFromDate = $this->matter->InterestFrom;

            // if ( $this->debugging ) {
            
            //     echo "\n\n Int RateSchedule ID = " . $this->matter->IntRateScheduleID;
                
            //     echo "\nTop of insertInterestTransactions InterestFromDate = ";

            //     echo Utils::stringFromClarionDate($this->InterestFromDate);
            // }

            $this->InterestToDate = ModelHelper::convertClarionDate( date("Y-m-d") );
            
            // OVERRIDE 
            if ( intval($this->matter->InterestEndDate) && $this->matter->InterestEndDate < $this->InterestToDate ) {
                $this->InterestToDate = $this->matter->InterestEndDate;
            }    
            
            //! OVERRIDE BECAUSE THIS PROCEDURE CAN ALSO CALCULATE THE BALANCE UP TO A CERTAIN DATE
            //if ( isset($request->interestDate) )  $this->InterestToDate = $request->interestDate; 
            

            if ( !intval($this->InterestFromDate) ) return;
            if ( !intval($this->InterestToDate) ) return;
            if ( $this->InterestFromDate >= $this->InterestToDate ) return;
            
            $this->LastInterestDate = $this->InterestFromDate;
            
            $breakLoop = false;

            $this->loopCounter = 0;

            while (!$breakLoop) {

                $this->loopCounter++;

                $MonthEndDate = Utils::getMonthEndFromClarionDate($this->LastInterestDate);

                // *************************************************************************
                // Setting $this->ThisInterestDate to the month end 
                // *************************************************************************
                $this->ThisInterestDate = $MonthEndDate;

                // *************************************************************************
                // Check if there are any Interest bearing transactions in this period
                // and if so, then set $this->ThisInterestDate to that transaction's date
                // to add interest up to this date
                // otherwise insert interest for this month (or for a period up to the next transacrion)
                // *************************************************************************

                $PeriodFromDate = $this->LastInterestDate;
                $PeriodToDate =  $MonthEndDate;
                
                foreach ($this->interestTransactionsQueue as $interestTransaction) {

                    if ( ( $interestTransaction->date >= $PeriodFromDate && $interestTransaction->date <= $PeriodToDate) && ($interestTransaction->date >= $this->InterestFromDate && $interestTransaction->date <= $this->InterestToDate)  ) {

                            $this->ThisInterestDate = $interestTransaction->date;

                            //if ($this->debugging) echo "\n\nAn interest transaction exists in this month SO.... Adjusted ThisInterestDate to ". Utils::stringFromClarionDate($this->ThisInterestDate);

                            break;

                    }
                }

                //CHECK IF THERE IS AN INTEREST SCHEDULE RATE DURING THIS PERIOD WHICH IS LESS THAN ThisInterestDate
                if ( intval($this->matter->IntRateScheduleID) ) {

                    $NextScheduleDate = $this->getNextScheduleDate($PeriodFromDate);

                    if ( intval($NextScheduleDate) && $NextScheduleDate < $this->ThisInterestDate) {

                        $this->ThisInterestDate = $NextScheduleDate;

                        if ($this->debugging) echo "\n\nA IntRateSchedule period exists in this period SO.... Adjusted ThisInterestDate to ". Utils::stringFromClarionDate($this->ThisInterestDate);

                    }

                }

                // Check if we have gone past the InterestToDate
                if ( $this->ThisInterestDate > $this->InterestToDate ) {
                    $this->ThisInterestDate = $this->InterestToDate;
                    $breakLoop = true;
                }

                //if ( $this->debugging ) echo "\nInside loop - ThisInterestDate = " . Utils::stringFromClarionDate($this->ThisInterestDate);

                $this->addInterestToQueue();

                $this->LastInterestDate = $this->ThisInterestDate + 1;

                if ($this->LastInterestDate > $this->InterestToDate) {
                    $breakLoop = true; 
                }

            }

        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }
    

    }

    private function addInterestToQueue() {

        try {
            if ( !$this->matter->InterestCompoundedFlag ) {

                // TRY AND COMBINE MANY INTEREST TRANS INTO ONE TO SAVE SPACE
                // BY SETTING TheNextInterestDate EITHER TO
                // THE NEXT TRANSACTION .... OR THE InterestToDate (if there are none)


                $this->TheNextInterestDate = $this->InterestToDate;

                foreach ($this->dateQueue as $date) {

                    if ( $date >= $this->ThisInterestDate) {

                        $this->TheNextInterestDate = $date;
                        //echo "\nFound a transaction SO... setting TheNextInterestDate to ". Utils::stringFromClarionDate($this->TheNextInterestDate);

                        break;

                    }
                }

                if ( intval($this->matter->IntRateScheduleID) ) {

                    $NextScheduleDate = $this->getNextScheduleDate($this->LastInterestDate);

                    if ( intval($NextScheduleDate) && $NextScheduleDate < $this->TheNextInterestDate) {

                        $this->TheNextInterestDate = $NextScheduleDate;

                        //echo "\n\nFound an InterestSchedule period SO... setting TheNextInterestDate to ". Utils::stringFromClarionDate($this->TheNextInterestDate);

                    }

                }

                if ($this->TheNextInterestDate > $this->InterestToDate)  $this->TheNextInterestDate = $this->InterestToDate;

                //echo "\n\nThe days between the last interest date (";
                //echo Utils::stringFromClarionDate($this->LastInterestDate);
                //echo ") and this interest date (" . Utils::stringFromClarionDate($this->TheNextInterestDate) . ")";
                //echo " is ";
                //echo $this->TheNextInterestDate - $this->LastInterestDate;
                
                
                if ( ($this->TheNextInterestDate - $this->LastInterestDate) > 62 ) {

                    //echo "\n********* THERE IS MORE THAN TWO MONTHS DIFFERENCE BETWEEN TheNextInterestDate AND LastInterestDate";

                    //DON'T BOTHER INSERTING THE INTEREST YET 
                    // SAVE THE DATE AND EXIT (SO IT KEEPS LOOPING AND INCREMENTING THE InterestToDate)
                    if ( !intval($this->SavedDate) ) $this->SavedDate = $this->LastInterestDate;

                    //echo " - So saving the LastInterestDate " . Utils::stringFromClarionDate($this->SavedDate) . ' and trying again';

                    return;
                }

            }

            $interestRecord = new \stdClass();
                
            $interestRecord->matterid = $this->matter->RecordID;
            $interestRecord->date = $this->ThisInterestDate;

            // These are calculated later in adjustTheBalances()
            $interestRecord->amount = 0; $interestRecord->vatamount = 0; $interestRecord->totalamount = 0;

            $interestRecord->type = 'I';
            $interestRecord->category = 'I';
            $interestRecord->trantype = 'Interest';
            $interestRecord->description = 'Interest';

            $interestRecord->interestrate = $this->getCurrentInterestRate($this->ThisInterestDate);

            // if ( $this->debugging ) {
            //     echo "\nThisInterestDate = " . Utils::stringFromClarionDate($this->ThisInterestDate);
            //     echo "\ninterestRecord->interestrate = $interestRecord->interestrate";
            // }

            if ( intval($this->SavedDate) ) {
                $interestRecord->lastinterestdate = $this->SavedDate;
                $this->SavedDate = 0;
            } else {
                $interestRecord->lastinterestdate = $this->LastInterestDate;
            }

            //INTEREST AT THE BEGINNING
            $interestRecord->timerstamp = 0;
            $interestRecord->employeename = 'System';
            $interestRecord->reference = '';

            //Adding a recordid so it has an id in DataTables
            $interestRecord->recordid = mt_rand();


            // if ( $this->debugging ) {
            //     echo "\n******** Added interestRecord *******\n";
            //     print_r($interestRecord);
            // }


            

            // Note: Putting at the beginning of the date array
            $this->insertColDebit($interestRecord);

        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }
    

    }

    private function calculateBalances() {

        try {

            $this->CostBalance = 0;
            $this->InterestBalance = 0;
            $this->RunningCapitalBalance = 0;
            $this->Balance = 0;

            $this->DebtorsTotalCosts = 0;       // Total Costs (Fees and Disbursements) (does not include Collection Commission, Interest, and Cost Journal Adjustments)
            $this->DebtorsTotalCommission = 0;  // Total Collection Commission
            $this->DebtorsTotalInterest = 0;    // Total Interest charged
            $this->DebtorsTotalDebits = 0;      // Total Cost Journal Adjustments (Manually inserted cost Adjustments)
            $this->DebtorsTotalCredits = 0;     // Total Payment Journal Adjustments (Manually inserted Payment Adjustments)
            $this->DebtorsTotalReceipts = 0;    // Total Receipts to date (does not include Payment Journal Adjustments)
                    

            if ( floatval($this->matter->InterestOnAmount) ) {
                $this->CostBalance = $this->matter->DebtorsOpeningBalance - $this->matter->InterestOnAmount;
            }
            
            $this->RunningCapitalBalance = $this->matter->InterestOnAmount;
            if ( !floatval($this->RunningCapitalBalance) ) $this->RunningCapitalBalance = $this->matter->DebtorsOpeningBalance;

            $this->addOpeningBalance();

            
            foreach ($this->queue as $dateArray) {

                foreach ($dateArray as $colDebit) {
                    $this->adjustTheBalances($colDebit);
                }

            }

            matter::where('RecordID', $this->matter->RecordID)
            ->update(array(
                'DebtorsTotalCosts'         => round($this->DebtorsTotalCosts,2),
                'DebtorsTotalCommission'    => round($this->DebtorsTotalCommission,2),
                'DebtorsTotalInterest'      => round($this->DebtorsTotalInterest,2),
                'DebtorsTotalDebits'        => round($this->DebtorsTotalDebits,2),
                'DebtorsTotalCredits'       => round($this->DebtorsTotalCredits,2),
                'DebtorsTotalReceipts'      => round($this->DebtorsTotalReceipts,2),
                'DebtorsCapitalBalance'     => round($this->RunningCapitalBalance,2),
                'DebtorsCostsBalance'       => round($this->CostBalance,2),
                'DebtorsInterestBalance'    => round($this->InterestBalance,2),
                'DebtorsBalance'            => round($this->InterestBalance + $this->CostBalance + $this->RunningCapitalBalance,2),
            ));

        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }
    
    }

    private function adjustTheBalances(&$colDebit) {

        try {

            if ($colDebit->type == 'A') return;   // OPENING BALANCE
            
            $vatRate = $this->setCurrentVatRate($colDebit->date);
            
            if ($colDebit->type == 'D') {   // COST
        
                if ( $colDebit->category == 'J') {
        
                    $this->RunningCapitalBalance += $colDebit->amount + $colDebit->vatamount;  //JOURNALS NOW ADJUST THE CAPITAL BALANCE
        
                    $this->TotalCapitalBalance += $colDebit->amount + $colDebit->vatamount;    //JOURNALS NOW ADJUST THE CAPITAL BALANCE
        
                    $this->DebtorsTotalDebits += $colDebit->amount + $colDebit->vatamount;
        
                } else {
                    
                    if ( $this->FeesMaxed || $this->FeesLimit) {
        
                        $colDebit->amount = $colDebit->vatamount = $colDebit->totalamount = 0;
        
                    } else {
        
                        if ( intval($this->colData->FeesUntilDate) && $colDebit->date > $this->colData->FeesUntilDate) {
        
                            $this->FeesLimit = true;
                            $colDebit->amount = $colDebit->vatamount = $colDebit->totalamount = 0;
                        
                        } else {
        
                            if ( floatval($colDebit->amount) && floatval($this->colData->MaxFees) ) {
        
                                if ( $this->DebtorsTotalCosts + $colDebit->amount + $colDebit->vatamount > $this->colData->MaxFees) {
        
                                    $this->AmountInclVatAvailable = $this->colData->MaxFees - $this->DebtorsTotalCosts;
        
                                    if ( floatval($vatRate) ) {
        
                                        $colDebit->amount = round( ($this->AmountInclVatAvailable * 100) / (100 + $vatRate) ,2);
                                        $colDebit->vatamount = $this->AmountInclVatAvailable - $colDebit->amount;
        
                                    } else {
        
                                        $colDebit->amount = $this->AmountInclVatAvailable;
                                        $colDebit->vatamount = 0;
        
                                    }
        
                                    $this->FeesMaxed = true;
        
                                }
        
                            }
                        }
                    }
        
                    if ( $this->FeesMaxed) {
        
                        $colDebit->description = '* ' . $colDebit->description . ' (Fee Limit)';
        
                    }
        
                    if ( $this->FeesLimit) {
        
                        $colDebit->description = '* ' . $colDebit->description . ' (Fee Date Limit)';
        
                    }
        
                    $this->CostBalance += $colDebit->amount + $colDebit->vatamount;
        
                    $this->adjustCostsForInduplumRule($colDebit);
        
                    $this->DebtorsTotalCosts += $colDebit->amount + $colDebit->vatamount;
        
                }
        
                $this->updateTransactionBalances($colDebit);
        
            } else if ($colDebit->type == 'W') {   // COLLECTION COMMISSION ADDED BY THE USER 
        
                $this->checkIfCommissionMaxed($colDebit); 
        
                $this->CostBalance += $colDebit->amount + $colDebit->vatamount;
        
                $this->adjustCostsForInduplumRule($colDebit);
        
                $this->DebtorsTotalCommission += $colDebit->amount + $colDebit->vatamount;
        
                $this->updateTransactionBalances($colDebit);
        
            } else if ($colDebit->type == 'X') {   // COLLECTION COMMISSION ADDED BY THE PROGRAM
        
                $this->checkIfCommissionMaxed($colDebit); 
        
                $this->CostBalance += $colDebit->amount + $colDebit->vatamount;
        
                $this->adjustCostsForInduplumRule($colDebit);
        
                $this->DebtorsTotalCommission += $colDebit->amount + $colDebit->vatamount;
        
                $this->addVirtualTransaction($colDebit);
        
            } else if ($colDebit->type == 'J' ) {   // INTEREST MANUALLY INSERTED BY USER
        
                $this->adjustInterestForInduplumRule($colDebit);
        
                $this->InterestBalance += $colDebit->amount;
        
                $this->DebtorsTotalInterest += $colDebit->amount;
        
                $this->updateTransactionBalances($colDebit);
        
            } else if ($colDebit->type == 'V'   ) {  // EMPLOYER'S COMMISSION
        
                $this->DebtorsTotalReceipts += $colDebit->amount + $colDebit->vatamount;
        
                $this->reduceTheBalances($colDebit);       // EMPLOYER'S COMMISSION MUST BE TREATED AS A "PAYMENT" BY THE DEBTOR - EXCEPT IT GOES TO THE EMPLOYER && NOT TO THE CLIENT
        
                $this->addVirtualTransaction($colDebit);
        
            
            } else if ($colDebit->type == 'P' ) {    // PAYMENT 
        
                // IF ITS A JOURNAL ENTRY
                if ( $colDebit->category == 'J') {
        
                    $this->RunningCapitalBalance -= $colDebit->amount + $colDebit->vatamount;
        
                    $this->TotalCapitalBalance -= $colDebit->amount + $colDebit->vatamount;
                                
                    $this->DebtorsTotalCredits += $colDebit->amount + $colDebit->vatamount;
        
                } else {
        
                    $this->DebtorsTotalReceipts += $colDebit->amount + $colDebit->vatamount;
        
                    //IF ANYTHING WAS PAID BY THE DEBTOR - REDUCE THE CAPTITAL BALANCE
                    $this->reduceTheBalances($colDebit);
        
                }
        
                $this->updateTransactionBalances($colDebit);
        
            } else if ($colDebit->type == 'I') {
        
                $monthEndDate = Utils::getMonthEndFromClarionDate($colDebit->lastinterestdate);
                
                if ( $colDebit->date == $monthEndDate) {
                    $monthEndFlag = 1;
                } else {
                    $monthEndFlag = 0;
                }
                
                //ADJUSTED BY REDUCE THE BALANCES
                $this->CalculateInterestOn = $this->RunningCapitalBalance;
                
                //INTEREST ON COSTS
                if ( $this->matter->InterestOnCostsFlag ) {
                    $this->CalculateInterestOn += $this->CostBalance;
                }
                
                
                //INTEREST IS COMPOUNDED
                if ( $this->matter->InterestCompoundedFlag ) {
                    $this->CalculateInterestOn += $this->InterestBalance;
                    $this->CalculateInterestOn -= $this->ThisMonthsInterest; //ONLY CALCULATE STRAIGHT INTEREST DURING THE MONTH
                }
        
                if ( $this->CalculateInterestOn > 0 && floatval($colDebit->interestrate) ) {
        
                    $noOfDays = $colDebit->date - $colDebit->lastinterestdate + 1;

                    if ( intval($noOfDays) ) {
        
                        $colDebit->amount = 0;
                        $fromDate = $colDebit->lastinterestdate;

                        $safetyValve = 0;

                        while ( Utils::getYearFromClarionDate( $fromDate ) < Utils::getYearFromClarionDate( $colDebit->date ) ) {
        
                            $safetyValve++;

                            if ($this->debugging ) {
                                echo "\nsafetyValve = $safetyValve";
                                echo "\n" . Utils::getYearFromClarionDate( $fromDate ) . " and  " . Utils::getYearFromClarionDate( $colDebit->date );
                            }

                            if ( $safetyValve > 100 ) break;

                            $endOfYearDate = Utils::getEndOfYearDateFromClarionDate($fromDate);
        
                            $daysInTheYear = Carbon::parse( Utils::stringFromClarionDate($fromDate) )->daysInYear;
        
                            $noOfDays = $endOfYearDate - $fromDate + 1;
        
                            $colDebit->amount += round(($this->CalculateInterestOn * $colDebit->interestrate /100 * $noOfDays/$daysInTheYear),2);
        
                            $fromDate = Utils::getBeginningOfNextYearFromClarionDate($fromDate);

                        }
                        
                        $daysInTheYear = Carbon::parse( Utils::stringFromClarionDate($fromDate) )->daysInYear;
        
                        $noOfDays = $colDebit->date - $fromDate + 1;
        
                        $colDebit->amount += round(($this->CalculateInterestOn * $colDebit->interestrate /100 * $noOfDays/$daysInTheYear),2);

                    }
        
                    if ( $this->InterestMaxed ) {
        
                        $colDebit->amount = 0;
        
                    } else {
        
                        $this->adjustInterestForInduplumRule($colDebit);
        
                    }

                    // if ( $this->debugging ) {
                    //     echo "\n\n***** Interest Amount ****";
                    //     echo "\ncolDebit->amount = " . $colDebit->amount;
                    //     echo "\nthis->CalculateInterestOn = " . $this->CalculateInterestOn;
                    //     echo "\nthis->DebtorsTotalInterest + colDebit->amount = " . ($this->DebtorsTotalInterest + $colDebit->amount);
                    //     echo "\nthis->colData->InterestEndAmount = " . $this->colData->InterestEndAmount;
                    // }


                    if ( floatval($colDebit->amount) && floatval($this->colData->InterestEndAmount) ) {

                        if ( $this->DebtorsTotalInterest + $colDebit->amount > $this->colData->InterestEndAmount) {
        
                            $colDebit->amount = $colDebit->amount - ( ($this->DebtorsTotalInterest + $colDebit->amount) - $this->colData->InterestEndAmount);
        
                            if ($colDebit->amount < 0)  $colDebit->amount = 0;
        
                            $this->InterestMaxed = true;
        
                        }
        
                    }
        
                }

                $this->InterestBalance += $colDebit->amount;
                $this->DebtorsTotalInterest += $colDebit->amount;

                if ( $this->CalculateInterestOn > 0 && $colDebit->interestrate) {
                    
                    // Intelligently format the interest rate based on the number of decimals in the interest rate https://stackoverflow.com/questions/2430084/php-get-number-of-decimal-digits
                    $decimals = ( (int) $colDebit->interestrate != $colDebit->interestrate ) ? (strlen($colDebit->interestrate) - strpos($colDebit->interestrate, '.')) - 1 : 0;

                    if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                        $colDebit->description = 'Rente van ' . number_format($colDebit->interestrate,$decimals) . '% op ' . $this->currencySymbol . number_format($this->CalculateInterestOn,2) . ' vanaf ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' tot ' . Utils::stringFromClarionDate($colDebit->date);
                    } else {
                        $colDebit->description = 'Interest at ' . number_format($colDebit->interestrate,$decimals) . '% on ' . $this->currencySymbol . number_format($this->CalculateInterestOn,2) . ' from ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' to ' . Utils::stringFromClarionDate($colDebit->date);
                    }
                    
                } else {
                    
                    if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                        $colDebit->description = 'Rente vanaf ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' tot ' . Utils::stringFromClarionDate($colDebit->date);
                    } else {
                        $colDebit->description = 'Interest from ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' to ' . Utils::stringFromClarionDate($colDebit->date);
                    }
                    
                }
                
                if ( $this->InterestMaxed ) {
        
                    $colDebit->description = '* ' . $colDebit->description . ' (Interest Limit)';
        
                }
        
                if ( $this->InDuplumFlag || $this->InDuplumMaxed) {
        
                    $colDebit->description = '# ' . $colDebit->description . ' (In Duplum)';
                    $this->InDuplumFlag = 0;
        
                }
        
                if ( $this->matter->InterestCompoundedFlag) {
                    if ( $monthEndFlag == 1) {
                        $this->ThisMonthsInterest = 0;
                    } else {
                        $this->ThisMonthsInterest += $colDebit->amount;
                    }                      
                }
        
                $this->addVirtualTransaction($colDebit);
        
            }

            
            /*echo "\n***********************************";
            echo "\nAdjusting Interest Transaction";
            echo "\nCDQ:Date = " . Utils::stringFromClarionDate($colDebit->date);
            echo "\nCDQ:Description = " . $colDebit->description;
            echo "\nCDQ:Amount = " . $colDebit->amount;
            echo "\nLOC:InDuplumFlag = " . $this->InDuplumFlag;
            echo "\nLOC:InDuplumMaxed = " . $this->InDuplumMaxed;
            echo "\nCOL:InterestEndAmount = " . $this->colData->InterestEndAmount;
            echo "\nLOC:InterestMaxed = " . $this->InterestMaxed;
            echo "\nLOC:CalculateInterestOn = " . $this->CalculateInterestOn;
            echo "\nLOC:DebtorsTotalInterest = " . $this->DebtorsTotalInterest;
            echo "\n";*/


            $colDebit->totalamount = $colDebit->amount + $colDebit->vatamount;
        
            $colDebit->interestbalance = $this->InterestBalance;
            $colDebit->costbalance = $this->CostBalance;
            $colDebit->capitalbalance = $this->RunningCapitalBalance;
            $colDebit->balance = $colDebit->capitalbalance  + $colDebit->costbalance + $colDebit->interestbalance;

        } catch(\Exception $e)  {
            throw new \Exception($e->getMessage());
        }
    

    }

    private function addOpeningBalance() {

        $record = new \stdClass();
        $record->matterid = $this->matter->RecordID;
        $record->date = 0;
        $record->type = 'A'; // GIVING ARBITARY CODE SO CAN DISPLAY MESSAGE IF USER TRIES TO DELETE
        $record->trantype = 'Balance';

        if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
            $record->description = 'Balans';
        } else {
            $record->description = 'Opening Balance';
        }

        $record->interestbalance = $this->InterestBalance;
        $record->costbalance = $this->CostBalance;
        $record->capitalbalance = $this->RunningCapitalBalance;
        $record->balance = $record->capitalbalance  + $record->costbalance + $record->interestbalance;
        $record->totalamount = $record->balance;

        $record->timerstamp = 0;
        $record->employeename = 'System';
        $record->reference = '';

        $this->addColDebit($record);

        ksort($this->queue);

    }


    private function updateTransactionBalances($colDebit)  {

        //if (isset($request->calculatePaymentPlanFlag)) return;

        if ($this->control->SaveColDebitTransactionsFlag ) {

            coldebit::where('recordid', $colDebit->recordid)
            ->update(array(
                'InterestBalance' => $this->InterestBalance,
                'CostBalance' => $this->CostBalance,
                'CapitalBalance' => $this->RunningCapitalBalance,
            ));
        }

    }

    private function adjustCostsForInduplumRule(&$colDebit) {

        $vatRate = $this->setCurrentVatRate($colDebit->date);
    
        if ( $this->InDuplumOption == 1 ) {
            $this->TheCapitalAmount = $this->TotalCapitalBalance;
        } else if ( $this->InDuplumOption == 2 ) {
            $this->TheCapitalAmount = $this->RunningCapitalBalance;
        } else {
            $this->InDuplumFlag = 0;
            $this->InDuplumAmount = 0;
            return;
        }
    
        if ( $this->colData->InDuplumAmount ) {
    
            try {
                $this->TheCapitalAmount = Utils::evaluate($this->colData->InDuplumAmount);
            } catch(\Exception $e)  {
                throw new \Exception($e->getMessage());
            }
    
        }
    
        if ( $this->InDuplumMaxed ) {
    
            $this->CostBalance -= $colDebit->amount + $colDebit->vatamount;
    
            $colDebit->description .= ' (in duplum)';
            $colDebit->amount = 0;
            $colDebit->vatamount = 0;
    
            return;
    
        }
    
        // COSTS ONLY APPLY TO NEW IN DUPLUM RULE (NCA)
        if (!$this->colData->NewInDuplumRuleFlag ) return;
    
        //! ONLY APPLY NEW IN DUPLUM RULE (NCA) AFTER THIS DATE
        if ( intval($this->colData->NewInDuplumRuleFromDate) && $colDebit->date < $this->colData->NewInDuplumRuleFromDate) return;
    
        if ( $this->InDuplumOption == 0 ) {
    
            $this->InDuplumFlag = 0;
            $this->InDuplumAmount = 0;
    
        } else {
    
            if ( $colDebit->amount + $colDebit->vatamount + $this->DebtorsTotalCosts + $this->DebtorsTotalCommission + $this->DebtorsTotalInterest > $this->TheCapitalAmount && $this->TheCapitalAmount > 0 ) {
    
                //WE ARE IN DUPLUM
                $colDebit->description .= ' (in duplum)';
    
                $this->InDuplumFlag = 1;
                $this->InDuplumMaxed = 1;
    
                // CHECK IF WE ARE IN DUPLUM EVEN WITHOUT THIS $colDebit->amount
    
                if ( $this->DebtorsTotalCosts + $this->DebtorsTotalCommission + $this->DebtorsTotalInterest > $this->TheCapitalAmount ) {
    
                    // WE ARE ALREADY IN DUPLUM WITHOUT THIS COST SO WE CANNOT ADD ANY MORE COSTS
                    $this->CostBalance -= ($colDebit->amount + $colDebit->vatamount);
                    $colDebit->amount = 0;
                    $colDebit->vatamount = 0;
    
                } else {
    
                    $this->InDuplumAmount = ($this->DebtorsTotalCosts + $this->DebtorsTotalCommission + $this->DebtorsTotalInterest + $colDebit->amount + $colDebit->vatamount) - $this->TheCapitalAmount;
    
                    if ( $colDebit->vatflag ) {
    
                        $amount = ($colDebit->amount + $colDebit->vatamount) - $this->InDuplumAmount;
    
                        $colDebit->amount = round($amount * 100 /(100 + $vatRate),2);
    
                        $colDebit->vatamount = round($colDebit->amount * $vatRate /100,2);
    
                    } else {
    
                        $colDebit->amount -= $this->InDuplumAmount;
                        $colDebit->vatamount = 0;
    
                    }
    
                    $this->CostBalance -= $this->InDuplumAmount;
    
                }
    
            } else {
    
                $this->InDuplumFlag = 0;
    
            }
    
        }
    
    }

    private function adjustInterestForInduplumRule(&$colDebit)  {

        if ( $this->InDuplumOption == 1 ) {
    
            $this->TheCapitalAmount = $this->TotalCapitalBalance;
    
        } else if ( $this->InDuplumOption == 2 ) {
    
            $this->TheCapitalAmount = $this->RunningCapitalBalance;
    
        } else {
    
            $this->InDuplumFlag = 0;
            $this->InDuplumAmount = 0;
            return;
    
        }
    
        if ( $this->colData->InDuplumAmount ) {
    
            try {
                $this->TheCapitalAmount = Utils::evaluate($this->colData->InDuplumAmount);
            } catch(\Exception $e)  {
                throw new \Exception($e->getMessage());
            }
    
    
        }
    
        //TOTAL COSTS AND TOTAL INTEREST = ORIGINAL CAPITAL AMOUNT
    
        if ( $this->InDuplumMaxed ) {
    
            $colDebit->description .= ' (in duplum)';
            $colDebit->amount = 0;
            $colDebit->vatamount = 0;
    
            return;
    
        }
    
        if ( $this->InDuplumOption == 0 ) {
    
            $this->InDuplumFlag = 0;
            $this->InDuplumAmount = 0;
    
        } else {
    
            if ( $this->colData->NewInDuplumRuleFlag ) {
    
                if ( $colDebit->amount + $colDebit->vatamount + $this->DebtorsTotalCosts + $this->DebtorsTotalCommission + $this->DebtorsTotalInterest > $this->TheCapitalAmount && $this->TheCapitalAmount > 0 ) {
    
                    $this->InDuplumAmount =  ($this->DebtorsTotalCosts + $this->DebtorsTotalCommission + $this->DebtorsTotalInterest + $colDebit->amount + $colDebit->vatamount) - $this->TheCapitalAmount;
    
                    $this->InDuplumFlag = 1;
                    $this->InDuplumMaxed = 1;
    
                    $colDebit->amount -= $this->InDuplumAmount;
    
                    if ( $colDebit->amount < 0 ) $colDebit->amount = 0;
    
                    $colDebit->description .= ' (in duplum)';
    
                } else {
    
                    $this->InDuplumFlag = 0;
    
                }
    
            } else {
    
                if ( $this->InterestBalance + $colDebit->amount  > $this->TheCapitalAmount && $this->TheCapitalAmount > 0 ) {
    
                    $this->InDuplumAmount = $this->InterestBalance + $colDebit->amount - $this->TheCapitalAmount;
    
                    $this->InDuplumFlag = 1;
                    $colDebit->amount -= $this->InDuplumAmount;
                    $colDebit->description .= ' (in duplum)';
    
                    if ($colDebit->amount < 0 ) $colDebit->amount = 0;
    
                } else {
    
                    $this->InDuplumFlag = 0;
    
                }
    
            }
    
        }
    
    }

    public function getCurrentInterestRate($date) {

        $returnValue = $this->matter->InterestRate;

        if ( intval($this->matter->IntRateScheduleID) ) {
            
            // See: https://laravel.com/docs/8.x/collections#method-last

            $intRatePeriod = $this->intRatePeriods->last(function ($value, $key) use($date) { return $value->FromDate <= intval($date); });

            if ( $intRatePeriod ) {
                $returnValue = $intRatePeriod->InterestRate;
            }

            if ( floatval($this->colData->IntRateScheduleVariance) ) {
                $returnValue += $this->colData->IntRateScheduleVariance;
            }

        }
        

        return $returnValue;

    }

    private function getNextScheduleDate($date) {

        $intRatePeriod = $this->intRatePeriods->firstWhere('FromDate','>=',$date);

        return $intRatePeriod ? $intRatePeriod->ToDate : 0;

    }

    private function checkIfCommissionMaxed(&$colDebit) {

        $vatRate = $this->setCurrentVatRate($colDebit->date);
    
        if ( $this->CommissionMaxed || $this->CommissionLimit ) {
    
            $colDebit->amount = 0;
            $colDebit->vatamount = 0;
    
        } else {
    
            if ( intval($this->colData->CommissionUntilDate) && $colDebit->date > $this->colData->CommissionUntilDate ) {
    
                $this->CommissionLimit = true;
                $colDebit->amount = 0;
                $colDebit->vatamount = 0;
    
            } else {
    
                if ( floatval($colDebit->amount) && floatval($this->colData->MaxCommission) ) {
    
                    if ( $this->DebtorsTotalCommission + $colDebit->amount + $colDebit->vatamount > $this->colData->MaxCommission ) {
    
                        $this->AmountInclVatAvailable = $this->colData->MaxCommission - $this->DebtorsTotalCommission;
    
                        if ( floatval($vatRate) ) {
    
                            $colDebit->amount = round( ($this->AmountInclVatAvailable * 100) / (100 + $vatRate) , 2);
                            $colDebit->vatamount = $this->AmountInclVatAvailable - $colDebit->amount;
    
                        } else {
    
                            $colDebit->amount = $this->AmountInclVatAvailable;
                            $colDebit->vatamount = 0;
                        }
    
                        $this->CommissionMaxed = true;
    
                    }
                }
    
            }
        }
    
        if ( $this->CommissionMaxed ) {
    
            $colDebit->description = '* ' . $colDebit->description . ' (Commission Limit)';
    
        }
        
        if ( $this->CommissionLimit ) {
    
            $colDebit->description = '* ' . $colDebit->description . ' (Commission Date Limit)';
    
        }
    }

    private function reduceTheBalances($colDebit) {

        $this->AmountToReduceCapitalBy = $colDebit->amount;
        $this->AmountToReduceCostsBy = 0;
        $this->ReduceCostsFlag = false;


        if ( $this->colData->ReceiptPercentToCostsFlag ) {

            if ( intval($this->matter->ReceiptPercentToDate) ) {

                if ( $colDebit->date <= $this->matter->ReceiptPercentToDate ) {

                    $this->ReduceCostsFlag = true;

                }

            } else {

                $this->ReduceCostsFlag = true;

            }

        }

        if ( $this->ReduceCostsFlag ) {

            $this->AmountToReduceCostsBy = round($colDebit->amount * $this->matter->ReceiptPercentToCosts / 100,2);

            $this->AmountToReduceCapitalBy = $colDebit->amount - $this->AmountToReduceCostsBy;

        }

        $this->reduceCapitalBalance();

        $this->LastInterestBalance = $this->InterestBalance;

    }

    private function reduceCapitalBalance() {

        $this->BalanceLeftOver = 0;

        // REDUCE THE CAPITAL AMOUNT FIRST AND THEN PAY OFF COSTS, THEN INTEREST.
        if ( $this->colData->ReduceCapitalFlag == 1 ) {

            $this->RunningCapitalBalance -= $this->AmountToReduceCapitalBy;

            if ( $this->RunningCapitalBalance < 0 ) {

                $this->CostBalance += $this->RunningCapitalBalance;
                $this->RunningCapitalBalance = 0;

                if ( $this->CostBalance < 0 ) {
                    $this->InterestBalance += $this->CostBalance;
                    $this->CostBalance = 0;
                }
            }
            
            if ( $this->ReduceCostsFlag ) {

                $this->CostBalance -= $this->AmountToReduceCostsBy;

                if ( $this->CostBalance < 0 ) {
                    $this->InterestBalance += $this->CostBalance;
                    $this->CostBalance = 0;
                }
            }

        // REDUCE THE INTEREST FIRST AND THEN PAY OFF COSTS, THEN CAPITAL.
        } else if ( $this->colData->ReduceCapitalFlag == 2 ) {

            $this->InterestBalance -= $this->AmountToReduceCapitalBy;

            if ( $this->InterestBalance < 0 ) {

                $this->CostBalance += $this->InterestBalance;
                $this->InterestBalance = 0;

                if ( $this->CostBalance < 0 ) {
                    $this->RunningCapitalBalance += $this->CostBalance;
                    $this->CostBalance = 0;
                }
            }

            if ( $this->ReduceCostsFlag ) {

                $this->CostBalance -= $this->AmountToReduceCostsBy;

                if ( $this->CostBalance < 0 ) {
                    $this->RunningCapitalBalance += $this->CostBalance;
                    $this->CostBalance = 0;
                }
            }

        // REDUCE THE CAPITAL AMOUNT FIRST AND THEN INTEREST THEN COSTS
        } else if ( $this->colData->ReduceCapitalFlag == 3 ) {

            $this->RunningCapitalBalance -= $this->AmountToReduceCapitalBy;

            if ( $this->RunningCapitalBalance < 0 ) {
                $this->InterestBalance += $this->RunningCapitalBalance;
                $this->RunningCapitalBalance = 0;

                if ( $this->InterestBalance < 0 ) {
                    $this->CostBalance += $this->InterestBalance;
                    $this->InterestBalance = 0;
                }
            }

            if ( $this->ReduceCostsFlag ) {

                $this->CostBalance -= $this->AmountToReduceCostsBy;

                if ( $this->CostBalance < 0 ) {

                    $this->RunningCapitalBalance += $this->CostBalance;
                    $this->CostBalance = 0;

                    if ( $this->RunningCapitalBalance < 0 ) {

                        $this->InterestBalance += $this->RunningCapitalBalance;
                        $this->RunningCapitalBalance = 0;

                        if ( $this->InterestBalance < 0 ) {

                            $this->CostBalance += $this->InterestBalance;
                            $this->InterestBalance = 0;
                        }
                    }
                }

            }

        //REDUCE THE INTEREST FIRST AND THEN CAPITAL AND THEN COSTS.
        } else if ( $this->colData->ReduceCapitalFlag == 4 ) {

            $this->InterestBalance -= $this->AmountToReduceCapitalBy;

            if ( $this->InterestBalance < 0 ) {

                $this->RunningCapitalBalance += $this->InterestBalance;
                $this->InterestBalance = 0;

                if ( $this->RunningCapitalBalance < 0 ) {
                    $this->CostBalance += $this->RunningCapitalBalance;
                    $this->RunningCapitalBalance = 0;
                }
            }

            if ( $this->ReduceCostsFlag ) {

                $this->CostBalance -= $this->AmountToReduceCostsBy;

                if ( $this->CostBalance < 0 ) {

                    $this->InterestBalance += $this->CostBalance;
                    $this->CostBalance = 0;

                    if ( $this->InterestBalance < 0 ) {

                        $this->RunningCapitalBalance += $this->InterestBalance;
                        $this->InterestBalance = 0;

                        if ( $this->RunningCapitalBalance < 0 ) {
                            $this->CostBalance += $this->RunningCapitalBalance;
                            $this->RunningCapitalBalance = 0;
                        }
                    }

                }

            }

        //PAY OFF COSTS, THEN INTEREST THEN ONLY REDUCE THE CAPITAL 
        } else {

            if ( $this->ReduceCostsFlag ) {
                $this->CostBalance -= $this->AmountToReduceCostsBy;
            } else {
                $this->CostBalance -= $this->AmountToReduceCapitalBy;
            }


            if ( $this->ReduceCostsFlag ) {

                if ( $this->CostBalance < 0 ) {

                    //HAVE REDUCED ALL THE COSTS SO WE NEED TO ADD THE EXTRA AMOUNT SO IT CAN BE DEDUCTED FROM THE OTHER BALANCES
                    $this->BalanceLeftOver = abs($this->CostBalance) + $this->AmountToReduceCapitalBy;
                    $this->CostBalance = 0;

                } else {

                    $this->BalanceLeftOver = $this->AmountToReduceCapitalBy;

                }

                $this->InterestBalance -= $this->BalanceLeftOver;

                if ( $this->InterestBalance < 0 ) {

                    $this->RunningCapitalBalance += $this->InterestBalance;
                    $this->InterestBalance = 0;

                }

            } else {

                // echo "\n>>>>>> reduceCapitalBalance <<<<<<";
                // echo "\nthis->ReduceCostsFlag = $this->ReduceCostsFlag";
                // echo "\nthis->CostBalance = $this->CostBalance";
                
                if ( $this->CostBalance < 0 ) {
                    
                    $this->InterestBalance += $this->CostBalance;
                    $this->CostBalance = 0;

                    //echo "\nthis->InterestBalance = $this->InterestBalance";
                    
                    
                    if ( $this->InterestBalance < 0 ) {
                        
                        $this->RunningCapitalBalance += $this->InterestBalance;
                        //echo "\nthis->RunningCapitalBalance = $this->RunningCapitalBalance";
                        $this->InterestBalance = 0;
                    }
                    
                }
                //echo "\n>>>>>>>>>>>>>>>>>>>>>>>>>>\n";

            }

        }

    }

    private function addVirtualTransaction($colDebit) {

        //if (isset($request->calculatePaymentPlanFlag)) return;
        
        if ( $this->control->SaveColDebitTransactionsFlag ) {

            /* Notes:
            1)  Columns must be in alphabetical order for bulk insert

            2) Have to convert vatamount to decimal using floatval($colDebit->vatamount)
            otherwise the MsSql PDO driver throws an error about converting varchar 1.65, for example, to int
            when trying to bulk insert. 
            Not sure why, but this is a work around.
            */

            $record = array(
                'amount' => $colDebit->amount,
                'capitalbalance' => $this->RunningCapitalBalance,
                'category' => $colDebit->category,
                'collcommflag' => isset($colDebit->collcommflag) ? $colDebit->collcommflag : 0,
                'costbalance' => $this->CostBalance,
                'date' => $colDebit->date,
                'description' => $colDebit->description,
                'documentcode' => isset($colDebit->documentcode) ? $colDebit->documentcode : null,
                'employeeid' => 0,
                'exportedflag' => 0,
                'interestbalance' => $this->InterestBalance,
                'matterid' => $colDebit->matterid,
                'overrideemocommflag' => isset($colDebit->overrideemocommflag) ? $colDebit->overrideemocommflag : 0,
                'timerstamp' => $colDebit->timerstamp,
                'type' => $colDebit->type,
                'vatamount' => floatval($colDebit->vatamount),
                'vatflag' => isset($colDebit->vatflag) ? $colDebit->vatflag : 0,
            );
            
            $this->virtualTransactions[] = $record;

        }

    }

    private function saveVirtualTransactions() {

        try {

            if ( count($this->virtualTransactions)  ) {

                // Bulk insert to speed it up
                coldebit::insert( $this->virtualTransactions );

            }

        } catch(\Exception $e)  {
            throw new \Exception('Error saving Virtual Transactions: ' . $e->getMessage());
        }

    }

    private function addCommissionRecord($colDebit) {

        try {

            $paymentAmount = $colDebit->amount;

            // Doing this because $colDebit is passed by reference from the array
            $record = $this->copyColDebit($colDebit);

            $vatRate = $this->setCurrentVatRate($record->date);

            $commission = $this->getCollCommAmount($record->date, $record->amount, $vatRate);

            if ( floatval($commission) ) {
                
                $record->matterid = $this->matter->RecordID;
                $record->type = 'X';
                $record->category = 'X';
                $record->trantype = 'Commission';
                $record->amount = round( $commission, 2);

                if ( floatval($vatRate) ) {
                    $record->vatflag = 1;
                    $record->vatamount = round($commission * ($vatRate / 100),2);
                } else {
                    $record->vatflag = 0;
                    $record->vatamount = 0;
                }

                $commissionPercent = $this->getCollCommMatterPercent($record->date);

                if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                    $record->description = 'Invorderingskommissie van ' . $commissionPercent . '% op ' . $this->currencySymbol . number_format($paymentAmount,2);
                } else {
                    $record->description = 'Collection Commission of ' . $commissionPercent . '% on ' . $this->currencySymbol . number_format($paymentAmount,2);
                }

                $record->totalamount = $record->amount + $record->vatamount;
                $record->timerstamp = $record->timerstamp + 1;
                $record->employeename = 'System';
                $record->reference = '';

                //Adding a recordid so it has an id in DataTables
                $record->recordid = mt_rand();

                $this->addColDebit($record);

                //IF CalculatePaymentPlanFlag THEN DO AdjustTheBalances.
            }

        } catch(\Exception $e)  {
            throw new \Exception('Error Adding Commission Record: '.$e->getMessage());
        }

    }

    private function addEmployerCommissionRecord($colDebit) {

        try {

            // Doing this because $colDebit is passed by reference from the array
            $record = $this->copyColDebit($colDebit);

            $commission = $this->getEmployerCommAmount($record);

            // if ( $this->debugging ) {
            //     echo "\nEmployer commission = $commission";
            //     return;
            // }

            if ( floatval($commission) ) {

                $grossPayment = round( ( ($record->amount * 100) / (100 - $this->colData->EMOCommissionPercent) ),2);

                if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                    $record->description = 'Werkgewerskommissie van ' . $this->colData->EMOCommissionPercent . '% op ' . $this->currencySymbol . number_format($grossPayment,2);
                } else {
                    $record->description = 'Employers Commission of ' . $this->colData->EMOCommissionPercent . '% on ' . $this->currencySymbol . number_format($grossPayment,2);
                }

                $record->matterid = $this->matter->RecordID;
                $record->type = 'V';
                $record->category = 'P';
                $record->trantype = 'Employer';
                $record->amount = $commission;
                $record->totalamount = $record->amount;
                $record->timerstamp = $record->timerstamp + 1;
                $record->employeename = 'System';
                $record->reference = '';

                //Adding a recordid so it has an id in DataTables
                $record->recordid = mt_rand();

                $this->addColDebit($record);

                //IF CalculatePaymentPlanFlag THEN DO AdjustTheBalances.
            }

        } catch(\Exception $e)  {
            throw new \Exception('Error Adding Employer Commission Record: '.$e->getMessage());
        }

    }

    private function getCollCommAmount($date, $amount, $vatRate) {

        try {

            $returnValue = 0;

            if (!floatval($amount) || $this->matter->DebtorCollCommOption == 'N') return $returnValue;
            
            $commissionPercent = $this->matter->DebtorCollCommPercent;
            $commissionLimit = $this->matter->DebtorCollCommPercent;

            if ( $this->matter->DebtorCollCommOption == 'U' ) {
                
                $commissionPercent = $this->control->CollCommPercent;
                $commissionLimit = $this->control->CollCommLimit;

            } else if ( $this->matter->DebtorCollCommOption == 'S' ) {
                
                $commissionPercent = $this->getCollCommPercent($date);
                $commissionLimit = $this->getCollCommLimit($date);

            }


            $returnValue = round($commissionPercent * $amount / 100,2);

            if ( abs($returnValue) > abs($commissionLimit) && $commissionLimit) {
                $returnValue = $commissionLimit;
            }

            if ( $this->matter->DebtorCollCommOption == 'I' ) {

                $vatAmount = round( $returnValue * ($vatRate / (100 + $vatRate)) ,2);
    
                $returnValue -= $vatAmount;
            }

            return $returnValue;

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    private function getCollCommMatterPercent($date) {

        try {

            $returnValue = $this->matter->DebtorCollCommPercent;

            if ( $this->matter->DebtorCollCommOption == 'N' ) {
                
                $returnValue = 0;

            } else if ( $this->matter->DebtorCollCommOption == 'U' ) {
                
                $returnValue = $this->control->CollCommPercent;

            } else if ( $this->matter->DebtorCollCommOption == 'S' ) {
                
                $returnValue = $this->getCollCommPercent($date);

            }

            return $returnValue;

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    private function getCollCommPercent($date) {

        $commissionRate = $this->commissionRates->where('ToDate','>=',$date)->firstWhere('FromDate','<=',$date);

        return $commissionRate ? $commissionRate->Commission : 0;

    }

    private function getCollCommLimit($date) {

            $commissionRate = $this->commissionRates->where('ToDate','>=',$date)->firstWhere('FromDate','<=',$date);

            return $commissionRate ? $commissionRate->Limit : 0;
    


    }

    private function setCurrentVatRate($date) {

        try {

            $returnValue = 0;

            if ( $this->matter->VatExemptFlag ) {

                $returnValue = 0;

            } else if ( $this->control->VatMethod != 'N' ) {

                if ($date < 79352) {

                    $returnValue = $this->control->VatPercent2; // Before 1 April 2018

                } else {

                    $returnValue = $this->control->VatPercent1;

                }
            }

            return $returnValue;

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    private function getEmployerCommAmount($colDebit) {

        try {

            $returnValue = 0;


        //     IF ~COL:EMOFirstDate THEN RETURN LOC:ReturnValue.
        //     IF LOC:Date < COL:EMOFirstDate THEN RETURN LOC:ReturnValue.
        //     IF COL:EMOEndDate > 0 and LOC:Date > COL:EMOEndDate THEN RETURN LOC:ReturnValue.
        //     IF ~COL:EMOCommissionPercent THEN RETURN LOC:ReturnValue.

        //     LOC:ReturnValue = Round(  ((LOC:Amount*100)/(100 - COL:EMOCommissionPercent)) - LOC:Amount  ,.01)

        //   !     MESSAGE('GetEmployerCommAmount||COL:EMOCommissionPercent = ' & COL:EMOCommissionPercent &|
        //   !             '|COL:EMOFirstDate = ' & FORMAT(COL:EMOFirstDate,@D17) &|
        //   !             '|COL:EMOFirstDate = ' & COL:EMOFirstDate &|
        //   !             '|LOC:Date = ' & FORMAT(LOC:Date,@D17) &|
        //   !             '|LOC:Date = ' & LOC:Date &|
        //   !             '|LOC:ReturnValue = ' & LOC:ReturnValue)

        //     RETURN LOC:ReturnValue


            if ( !floatval($colDebit->amount) ) return $returnValue;

            if ( !intval($this->colData->EMOFirstDate) ) return $returnValue;
            
            if ( $colDebit->date < $this->colData->EMOFirstDate ) return $returnValue;
            
            if ( $this->colData->EMOEndDate > 0 && $colDebit->date > $this->colData->EMOEndDate ) return $returnValue;
            
            if ( !floatval($this->colData->EMOCommissionPercent) ) return $returnValue;

            $returnValue = round( ( ($colDebit->amount * 100) / (100 - $this->colData->EMOCommissionPercent) ) - $colDebit->amount  , 2);

            return $returnValue;

        } catch(\Exception $e)  {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage());
        }

    }

    private function copyColDebit($colDebit) {

        $returnObject = new \stdClass();
    
        $returnObject->matterid = $colDebit->matterid;
        $returnObject->colcostid = $colDebit->colcostid;
        $returnObject->employeeid = $colDebit->employeeid;
        $returnObject->date = $colDebit->date;
        $returnObject->type = $colDebit->type;
        $returnObject->description = $colDebit->description;
        $returnObject->interestrate = $colDebit->interestrate;
        $returnObject->amount = $colDebit->amount;
        $returnObject->vatamount = $colDebit->vatamount;
        $returnObject->documentcode = $colDebit->documentcode;
        $returnObject->documentflag = $colDebit->documentflag;
        $returnObject->vatflag = $colDebit->vatflag;
        $returnObject->collcommflag = $colDebit->collcommflag;
        $returnObject->category = $colDebit->category;
        $returnObject->interestflag = $colDebit->interestflag;
        $returnObject->reference = $colDebit->reference;
        $returnObject->monthlyinterestflag = $colDebit->monthlyinterestflag;
        $returnObject->balance = $colDebit->balance;
        $returnObject->costbalance = $colDebit->costbalance;
        $returnObject->interestbalance = $colDebit->interestbalance;
        $returnObject->capitalbalance = $colDebit->capitalbalance;
        $returnObject->timerstamp = $colDebit->timerstamp;
        $returnObject->batchid = $colDebit->batchid;
        $returnObject->transid = $colDebit->transid;
        $returnObject->lineid = $colDebit->lineid;
        $returnObject->recordid = $colDebit->recordid;
        $returnObject->exportedflag = $colDebit->exportedflag;
        $returnObject->origin = $colDebit->origin;
        $returnObject->employersadminfeeflag = $colDebit->employersadminfeeflag;
        $returnObject->overrideemocommflag = $colDebit->overrideemocommflag;

        return $returnObject;

    }

    private function formatColDebit(&$colDebit, $tablePosition) {

        $colDebit->tablePosition = $tablePosition;

        $colDebit->formatteddate = $colDebit->date ? Utils::stringFromClarionDate($colDebit->date, "d M Y") : '';
        $colDebit->typedescription = $this->getTypeDescription($colDebit);

        if ( isset($colDebit->amount) ) {
            if ($colDebit->type == 'P' || $colDebit->type == 'V') {
                $colDebit->amount = number_format(-$colDebit->amount,2);
            } else {
                $colDebit->amount = number_format($colDebit->amount,2);
            }
        } else {
            $colDebit->amount = number_format(0,2);
        }

        if (isset($colDebit->vatamount) ) {
            if ($colDebit->type == 'P' || $colDebit->type == 'V') {
                $colDebit->vatamount = number_format(-$colDebit->vatamount,2);
            } else {
                $colDebit->vatamount = number_format($colDebit->vatamount,2);
            }
        } else {
            $colDebit->vatamount = number_format(0,2);
        }

        if (isset($colDebit->totalamount) ) {
            if ($colDebit->type == 'P' || $colDebit->type == 'V') {
                $colDebit->totalamount = number_format(-$colDebit->totalamount,2);
            } else {
                $colDebit->totalamount = number_format($colDebit->totalamount,2);
            }
        } else {
            $colDebit->totalamount = number_format($colDebit->amount + $colDebit->vatamount,2);
        }

        $colDebit->interestbalance = isset($colDebit->interestbalance) ? number_format($colDebit->interestbalance,2) : null;
        $colDebit->costbalance = isset($colDebit->costbalance) ? number_format($colDebit->costbalance,2) : null;
        $colDebit->capitalbalance = isset($colDebit->capitalbalance) ? number_format($colDebit->capitalbalance,2) : null;
        $colDebit->balance = isset($colDebit->balance) ? number_format($colDebit->balance,2) : null;

    }

    private function getTypeDescription($colDebit) {

        $type = $colDebit->type;
        $trantype = isset($colDebit->trantype) ? $colDebit->trantype : null;
        $category = isset($colDebit->category) ? $colDebit->category : null;

        if ($type == 'P') {
            if ($category == 'P') {
                $returnValue = 'Payment';
            } else if ($category == 'J') {
                $returnValue = 'Journal';
            } else {
                $returnValue = 'Unknown';
            }
        } else if ($type == 'V') {
            $returnValue = '*Payment';
        } else if ($type == 'J') {
            $returnValue = '*Interest';
        } else if ($type == 'I' || $type == 'Y') {
            if ($trantype == 'In Duplum') {
                $returnValue = 'In Duplum';
            } else {
                $returnValue = 'Interest';
            }
        } else if ($type == 'A') {
            $returnValue = 'Balance';
        } else if ($type == 'X' || $type == 'W') {
            $returnValue = 'Commission';
        } else {
            if ($category == 'C') {
                $returnValue = 'Fee';
            } else if ($category == 'O') {
                $returnValue = 'Other';
            } else if ($category == 'A') {
                $returnValue = 'Admin Fee';
            } else if ($category == 'S') {
                $returnValue = 'Sheriff\'s Fee';
            } else if ($category == 'T') {
                $returnValue = 'Tracing Fee';
            } else if ($category == 'R') {
                $returnValue = 'Revenue Stamp';
            } else if ($category == 'P') {
                $returnValue = 'Postage';
            } else if ($category == 'J') {
                $returnValue = 'Journal';
            } else {
                $returnValue = 'Unknown';
            }
        }

        return $returnValue;

    }


    private function addColDebit($colDebit) {

        if (!Arr::exists($this->queue,$colDebit->date)) {

            $this->queue[$colDebit->date] = Array();

        }
        array_push($this->queue[$colDebit->date],$colDebit);

    }

    private function insertColDebit($colDebit) {

        if (!Arr::exists($this->queue,$colDebit->date)) {

            $this->queue[$colDebit->date] = Array();

        }
        array_unshift($this->queue[$colDebit->date],$colDebit);

    }

    public function printQueue( $heading = '' ) {

        echo "\n\n" . $heading;

        foreach ($this->queue as $dateArray) {

            foreach ($dateArray as $colDebit) {

                echo "\n" .Utils::stringFromClarionDate($colDebit->date) . " " . $colDebit->timerstamp . " " . $colDebit->type  . " " . $colDebit->description; 

            }
        }

    }


    public function sortQueue( $debuggingFlag = false) {

        ksort($this->queue);

        foreach ($this->queue as $key => $dateArray) {

            if ( $debuggingFlag ) {

                echo "\nDOING " . Utils::stringFromClarionDate($key) . "\n"; 
            }


            usort($dateArray, function($a, $b) use($debuggingFlag) { 

                // Order by date, timerstamp, type, recordid
                // $returnValue = $a->date - $b->date;
                // if ( $returnValue == 0 )$returnValue = $a->timerstamp - $b->timerstamp;
                // if ( $returnValue == 0 )$returnValue = strcmp($a->type, $b->type);
                //if ( $returnValue == 0 )$returnValue = $a->recordid - $b->recordid;

                //$returnValue = $a->timerstamp - $b->timerstamp;

                if ($a->timerstamp == $b->timerstamp) {
                    $returnValue =  0;
                }
                $returnValue = ($a->timerstamp < $b->timerstamp) ? -1 : 1;

                // if ($a->date == $b->date) {

                //     if ($a->timerstamp > $b->timerstamp) {

                //         $returnValue = 1;
                        
                //     } else if ($a->timerstamp == $b->timerstamp) {

                //         //$returnValue = 0;
                //         $returnValue = strcmp($a->type, $b->type);
                //         //$returnValue = $a->recordid - $b->recordid;

                //     } else if ($a->timerstamp < $b->timerstamp) {

                //         $returnValue = -1;
                //     }

                // } else if ($a->date > $b->date) {

                //     $returnValue = 1;

                // } else if ($a->date < $b->date) {

                //     $returnValue = -1;

                // }
 

                if ( $debuggingFlag ) {

                    echo "\na) " .Utils::stringFromClarionDate($a->date) . " " . $a->timerstamp . " " . $a->type  . " " . $a->description; 
                    echo "   (b) " .Utils::stringFromClarionDate($b->date) . " " . $b->timerstamp . " " . $b->type  . " " . $b->description; 
                    echo "   ReturnValue: " . $returnValue; 

                }



                return $returnValue;

            });        

        }


    }


}