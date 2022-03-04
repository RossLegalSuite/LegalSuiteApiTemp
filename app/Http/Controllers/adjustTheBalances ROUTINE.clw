<?php
/*
private function adjustTheBalances(&$colDebit) {

    if ($colDebit->type == 'A') return;   // OPENING BALANCE
    
    $vatRate = $this->setCurrentVatRate($colDebit->date);
    
    if ($colDebit->type == 'D') {   // COST

        if ( $colDebit->category == 'J') {

            $this->RunningCapitalBalance += $colDebit->amount + $colDebit->vatamount;  //JOURNALS NOW ADJUST THE CAPITAL BALANCE

            $this->TotalCapitalBalance += $colDebit->amount + $colDebit->vatamount;    //JOURNALS NOW ADJUST THE CAPITAL BALANCE

            $this->DebtorsTotalDebits += $colDebit->amount + $colDebit->vatamount;

        } else {
            
            if ( $this->FeesMaxed || $this->FeesLimit) {

                $colDebit->amount = 0;
                $colDebit->vatamount = 0;

            } else {

                if ( $this->colData->FeesUntilDate && $colDebit->date > $this->colData->FeesUntilDate) {

                    $this->FeesLimit = true;
                    $colDebit->amount = 0;
                    $colDebit->vatamount = 0;
                
                } else {

                    if ( $colDebit->amount && $this->colData->MaxFees) {

                        if ( $this->DebtorsTotalCosts + $colDebit->amount + $colDebit->vatamount > $this->colData->MaxFees) {

                            $this->AmountInclVatAvailable = $this->colData->MaxFees - $this->DebtorsTotalCosts;

                            if ( $this->VatRate) {

                                $colDebit->amount = round( ($this->AmountInclVatAvailable * 100) / (100 + $this->VatRate) ,2);
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

        $this->saveVirtualTransaction($colDebit);

    } else if ($colDebit->type == 'J' ) {   // INTEREST MANUALLY INSERTED BY USER

        $this->adjustInterestForInduplumRule($colDebit);

        $this->InterestBalance += $colDebit->amount;

        $this->DebtorsTotalInterest += $colDebit->amount;

        $this->updateTransactionBalances($colDebit);

    } else if ($colDebit->type == 'V'   ) {  // EMPLOYER'S COMMISSION

        $this->DebtorsTotalReceipts += $colDebit->amount + $colDebit->vatamount;

        $this->reduceTheBalances($colDebit);       // EMPLOYER'S COMMISSION MUST BE TREATED AS A "PAYMENT" BY THE DEBTOR - EXCEPT IT GOES TO THE EMPLOYER && NOT TO THE CLIENT

        $this->saveVirtualTransaction($colDebit);

    
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

        if ( $colDebit->date = $monthEndDate) {
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

        if ( $this->CalculateInterestOn > 0 && $colDebit->interestrate) {

            $noOfDays = $colDebit->date - $colDebit->lastinterestdate + 1;

            if ( $noOfDays > 0 ) {

                $colDebit->amount = 0;
                $fromDate =  $colDebit->lastinterestdate;

                while (Utils::getYearFromClarionDate( $fromDate ) < Utils::getYearFromClarionDate( $colDebit->date ) {

                    $endOfYearDate = Utils::getEndOfYearDateFromClarionDate($fromDate);

                    $daysInTheYear = Carbon::parse( Utils::stringFromClarionDate($fromDate) )->daysInYear;

                    $noOfDays = $endOfYearDate - $fromDate + 1;

                    $colDebit->amount += round(($this->CalculateInterestOn * $colDebit->interestrate /100 * $noOfDays/$daysInTheYear),2);

                    $fromDate = Utils::getBeginningOfYearDateFromClarionDate($fromDate+1);

                }

                $daysInTheYear = Carbon::parse( Utils::stringFromClarionDate($fromDate) )->daysInYear;

                $noOfDays = $colDebit->date - $fromDate + 1;

                $colDebit->amount += round(($this->CalculateInterestOn * $colDebit->interestrate /100 * $noOfDays/$daysInTheYear),2);
            }

            if ( $this->InterestMaxed ) {

                $colDebit->amount = 0;

            } else {

                $this->ajustInterestForInduplumRule($colDebit);

            }


            if ( $colDebit->amount && $this->colData->InterestEndAmount) {

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

            if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                $record->description = 'Rente van ' . number_format($colDebit->interestRate,4) . '% op ' . $this->currencySymbol . number_format($this->CalculateInterestOn,2) . ' vanaf ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' tot ' . Utils::stringFromClarionDate($colDebit->date);
            } else {
                $record->description = 'Interest at ' . number_format($colDebit->interestRate,4) . '% on ' . $this->currencySymbol . number_format($this->CalculateInterestOn,2). ' from ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' to ' . Utils::stringFromClarionDate($colDebit->date);
            }

        } else {

            if ( $this->matter->DocumentLanguageID == $this->control->AfrikaansID ) {
                $record->description = 'Rente vanaf ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' tot ' . Utils::stringFromClarionDate($colDebit->date);
            } else {
                $record->description = 'Interest from ' . Utils::stringFromClarionDate($colDebit->lastinterestdate) . ' to ' . Utils::stringFromClarionDate($colDebit->date);
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

        $this->saveVirtualTransaction($colDebit);

    }

    $colDebit->totalamount = $colDebit->amount + $colDebit->vatamount;

    $colDebit->interestbalance = $this->InterestBalance;
    $colDebit->costbalance = $this->CostBalance;
    $colDebit->capitalbalance = $this->RunningCapitalBalance;
    $colDebit->balance = $colDebit->capitalbalance  + $colDebit->costbalance + $colDebit->interestbalance;
    //PUT($colDebit->ColDebitQueue)
}
*/
