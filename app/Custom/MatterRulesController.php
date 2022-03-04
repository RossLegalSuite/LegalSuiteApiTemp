<?php

namespace App\Custom;

use App\Custom\ModelHelper;
use App\GenericTableModels\bonddata;
use App\GenericTableModels\coldata;
use App\GenericTableModels\control;
use App\GenericTableModels\conveydata;
use App\GenericTableModels\docgen;
use App\GenericTableModels\employee;
use App\GenericTableModels\matemployee;
use App\GenericTableModels\matparty;
use App\GenericTableModels\matter;
use App\GenericTableModels\party;
use Illuminate\Support\Facades\DB;

class MatterRulesController
{
    public function storeRecord($request)
    {
        if (! isset($request['clientid'])) {
            $returnData['errors'] = 'Please specify the Client for this Matter';

            return $returnData;
        }

        // Check if loggedinemployeeid was sent as part of the $request
        if (! isset($request['loggedinemployeeid'])) {
            $returnData['errors'] = 'The LoggedInEmployeeId was not specified. This is required to get the Matter Defaults. Please set loggedinemployeeid to the RecordID of the logged in Employee.';

            return $returnData;
        }

        //Convert the $request array into an object (for better syntax)
        $matter = (object) $request;

        $this->initializeData($matter, $request['loggedinemployeeid']);

        $this->setMatterDefaults($matter, $request['loggedinemployeeid']);

        $this->validateData($matter);

        //***********************************************************
        // Set the FileRef
        //***********************************************************
        $party = party::where('RecordID', $request['clientid'])->get();

        if (! $party) {
            $returnData['errors'] = 'An error was encountered getting the Client ('.$request['clientid'].') in the Party table. It is required to create the FileRef for the Matter.';

            return $returnData;
        }

        $matterPrefix = $party[0]->MatterPrefix;

        if (! $matterPrefix) {
            $returnData['errors'] = 'No MatterPrefix was retrieved from the Party table. It is required to create the FileRef of the Matter.';

            return $returnData;
        }

        $control = control::select('MatterPrefixOption')->first();

        if (! $control) {
            $returnData['errors'] = 'An error was encountered getting the Control table. It is required to create the FileRef of the Matter.';

            return $returnData;
        }

        $matterPrefixOption = $control->MatterPrefixOption;

        $this->setMatterFileRef($matter, $matterPrefix, $matterPrefixOption);

        $this->sanitizeData($matter, $request['loggedinemployeeid']);

        $returnData = matter::create((array) $matter);

        $matter->recordid = $returnData->recordid;

        // ***************************************************************************
        // Add the Client, Plaintiff, Seller, Mortgagor  etc
        // ***************************************************************************
        $this->addMatterParties($matter);

        // ***************************************************************************
        // Add the Matter Employee
        // ***************************************************************************
        $this->addMatterEmployee($matter);

        // ***************************************************************************
        // Add the ColData or BondData and ConveyData records (if they don't exist)
        // ***************************************************************************
        $this->addSiblingTables($matter);

        // ***************************************************************************
        // To DO: Add TakeOnDebit
        // ***************************************************************************
        /*IF SELF.Request = InsertRecord
            EMP:RecordID  = MAT:EmployeeID
            Access:Employee.Fetch(EMP:PrimaryKey)
            IF EMP:TakeOnDebitFlag AND EMP:TakeOnDebitID
            SetTag:PtrM(TAG:FeeCode,EMP:TakeOnDebitID)
            AddFeeNote(GLO:EmployeeId,MAT:CostCentreID)
            NewTag:PtrM(Tag:FeeCode)
            END
        END*/

        return $returnData;
    }

    public function updateRecord($request)
    {

        //PROPSQL('INSERT EmployeeLogFile SELECT ' & TODAY() & ',' & CLOCK() & ',''' & StripSQL(MAT:Description) & ''',0,''Matter'',2,' & CEM:RecordID & ',' & MAT:RecordID & ',''' & MAT:FileRef & ''',''' & GlobalErrors.GetProcedureName() & '''','UpdateMatter')

        // Check if loggedinemployeeid was sent as part of the $request
        if (! isset($request['loggedinemployeeid'])) {
            $returnData['errors'] = 'LoggedInEmployeeId was not specified. This is required to record who updated the Matter. Please set loggedinemployeeid to the RecordID of the logged in Employee.';

            return $returnData;
        }

        //Convert the $request array into an object (for better syntax)
        $matter = (object) $request;

        $this->validateData($matter);

        $this->sanitizeData($matter, $request['loggedinemployeeid']);

        // ***************************************************************************
        // Check if they are consolidating the Matter with a proper consolidated Matter
        // ***************************************************************************
        if ($matter->consolidatedflag !== '0' || $matter->consolidatedflag !== '4') {
            $matter->consolidateid = '0';
        }

        $this->checkConsolidation($matter);
        $this->checkOldCode($matter);
        $this->checkAlternateRef($matter);
        $this->checkArchiveNumber($matter);

        date_default_timezone_set('Africa/Johannesburg');
        $matter->updatedbydate = ModelHelper::convertClarionDate(date('Y-m-d'));
        $matter->updatedbytime = ModelHelper::convertClarionTime(date('H:i:s'));

        // Save the Record
        $returnData = matter::findOrFail($matter->recordid);

        // RecordID is auto-incrementing
        $saveMatterRecordid = $matter->recordid;

        unset($matter->recordid);

        $returnData->update((array) $matter);

        // ***************************************************************************
        // Add the ColData or BondData and ConveyData records (if they don't exist)
        // ***************************************************************************
        $matter->recordid = $saveMatterRecordid;

        $this->addSiblingTables($matter);

        return $returnData;
    }

    private function initializeData(&$matter, $employeeId)
    {
        try {
            $control = control::select(['defaultlanguageid', 'businessbankid', 'trustbankid'])->first();
            if (! $control) {
                throw new \Exception('An error was encountered getting the Control table. It is required to initialize the Matter record.');
            }

            $employee = employee::select(['branchid', 'feeestimatewarningflag'])->where('RecordID', $employeeId)->first();
            if (! $employee) {
                throw new \Exception('An error was encountered getting the Branch ID from the Employee table. It is required to initialize the Matter record.');
            }

            if (! isset($matter->dateinstructed)) {
                $matter->dateinstructed = ModelHelper::convertClarionDate(date('Y-m-d'));
            }

            if (! isset($matter->description)) {
                $matter->description = 'New Matter';
            }

            $matter->addeddefaultpartiesflag = 1;

            $matter->employeeid = $employeeId;

            // Prime new record - the client app can just send the clientid and employeeid!!
            // Get the last Matter this Employee add
            // or the last Matter Added for this client (as a default)
            // Because the ClientFeeSheet depends on the Matter Type

            $lastMatterAdded = matter::select(['mattertypeid', 'clientfeesheetid', 'debtorfeesheetid', 'documentlanguageid', 'accountslanguageid', 'stagegroupid', 'costcentreid', 'docgenid', 'todogroupid', 'defaultbillingrateid'])
            ->whereRaw('mattertypeid is not null and (Matter.employeeid = '.$employeeId.' or Matter.clientid = '.$matter->clientid.')')
            ->orderBy('Matter.RecordID', 'desc')->first();

            if (! $lastMatterAdded) {
                $lastMatterAdded = matter::select(['mattertypeid', 'clientfeesheetid', 'debtorfeesheetid', 'documentlanguageid', 'accountslanguageid', 'stagegroupid', 'costcentreid', 'docgenid', 'todogroupid', 'defaultbillingrateid'])
                ->orderBy('Matter.RecordID', 'desc')->first();
            }

            if ($lastMatterAdded) {
                if (! isset($matter->mattertypeid)) {
                    $matter->mattertypeid = $lastMatterAdded->mattertypeid;
                }
                if (! isset($matter->clientfeesheetid)) {
                    $matter->clientfeesheetid = $lastMatterAdded->clientfeesheetid;
                }
                if (! isset($matter->debtorfeesheetid)) {
                    $matter->debtorfeesheetid = $lastMatterAdded->debtorfeesheetid;
                }
                if (! isset($matter->documentlanguageid)) {
                    $matter->documentlanguageid = $lastMatterAdded->documentlanguageid;
                }
                if (! isset($matter->accountslanguageid)) {
                    $matter->accountslanguageid = $lastMatterAdded->accountslanguageid;
                }
                if (! isset($matter->stagegroupid)) {
                    $matter->stagegroupid = $lastMatterAdded->stagegroupid;
                }
                if (! isset($matter->costcentreid)) {
                    $matter->costcentreid = $lastMatterAdded->costcentreid;
                }
                if (! isset($matter->docgenid)) {
                    $matter->docgenid = $lastMatterAdded->docgenid;
                }
                if (! isset($matter->todogroupid)) {
                    $matter->todogroupid = $lastMatterAdded->todogroupid;
                }
                if (! isset($matter->defaultbillingrateid)) {
                    $matter->defaultbillingrateid = $lastMatterAdded->defaultbillingrateid;
                }
                if (! isset($matter->businessbankid)) {
                    $matter->businessbankid = $lastMatterAdded->businessbankid;
                }
                if (! isset($matter->trustbankid)) {
                    $matter->trustbankid = $lastMatterAdded->trustbankid;
                }
                if (! isset($matter->branchid)) {
                    $matter->branchid = $lastMatterAdded->branchid;
                }
                if (! isset($matter->feeestimatewarningflag)) {
                    $matter->feeestimatewarningflag = $lastMatterAdded->feeestimatewarningflag;
                }
                if (! isset($matter->collcommoption)) {
                    $matter->collcommoption = $lastMatterAdded->collcommoption;
                }
                if (! isset($matter->debtorcollcommoption)) {
                    $matter->debtorcollcommoption = $lastMatterAdded->debtorcollcommoption;
                }
            }

            // This can be sent as a null
            if (! isset($matter->consolidatedflag)) {
                $matter->consolidatedflag = '0';
                $matter->consolidateid = '0';
            }

            if (! isset($matter->collcommoption)) {
                $matter->collcommoption = 'N';
                $matter->collcommpercent = '0';
                $matter->collcommlimit = '0';
            }

            if (! isset($matter->debtorcollcommoption)) {
                $matter->debtorcollcommoption = 'N';
                $matter->debtorcollcommpercent = '0';
                $matter->debtorcollcommlimit = '0';
            }

            //Override these if set in the Control table
            if (! isset($matter->businessbankid)) {
                $matter->businessbankid = $control->businessbankid;
            }
            if (! isset($matter->trustbankid)) {
                $matter->trustbankid = $control->trustbankid;
            }

            if (! isset($matter->documentlanguageid)) {
                $matter->documentlanguageid = $control->defaultlanguageid;
            }
            if (! isset($matter->accountslanguageid)) {
                $matter->accountslanguageid = $control->defaultlanguageid;
            }

            //Override these if set in the Employee table
            if (! isset($matter->branchid)) {
                $matter->branchid = $employee->branchid;
            }
            if (! isset($matter->feeestimatewarningflag)) {
                $matter->feeestimatewarningflag = $employee->feeestimatewarningflag;
            }

            //***********************************************************
            // Set the Archive Flags & set Access to Open
            //***********************************************************
            $matter->archivestatus = '0';
            $matter->archiveflag = '0';
            $matter->archiveno = '0';
            $matter->access = 'O';
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function setMatterDefaults(&$matter, $employeeId)
    {
        $matDefs = \App\GenericTableModels\matdef::whereRaw('matdef.employeeid = '.$employeeId.' AND ( matdef.clientid = '.$matter->clientid.' OR matdef.clientid = 0)')->orderBy('ClientId', 'desc')->first();

        if ($matDefs) {
            if (isset($matDefs->docgenid)) {
                $matter->docgenid = $matDefs->docgenid;
            }
            if (isset($matDefs->mattertypeid)) {
                $matter->mattertypeid = $matDefs->mattertypeid;
            }
            if (isset($matDefs->documentlanguageid)) {
                $matter->documentlanguageid = $matDefs->documentlanguageid;
            }
            if (isset($matDefs->employeeid)) {
                $matter->employeeid = $matDefs->employeeid;
            }
            if (isset($matDefs->extrascreenid)) {
                $matter->extrascreenid = $matDefs->extrascreenid;
            }
            if (isset($matDefs->bankid)) {
                $matter->bankid = $matDefs->bankid;
            }
            if (isset($matDefs->filecabinet)) {
                $matter->filecabinet = $matDefs->filecabinet;
            }
            if (isset($matDefs->discount)) {
                $matter->discount = $matDefs->discount;
            }
            if (isset($matDefs->prescriptiondate)) {
                $matter->prescriptiondate = $matDefs->prescriptiondate;
            }
            if (isset($matDefs->casenumber)) {
                $matter->casenumber = $matDefs->casenumber;
            }
            if (isset($matDefs->access)) {
                $matter->access = $matDefs->access;
            }
            if (isset($matDefs->theirref)) {
                $matter->theirref = $matDefs->theirref;
            }
            if (isset($matDefs->contact)) {
                $matter->contact = $matDefs->contact;
            }
            if (isset($matDefs->salutation)) {
                $matter->salutation = $matDefs->salutation;
            }
            if (isset($matDefs->oldref)) {
                $matter->oldref = $matDefs->oldref;
            }
            if (isset($matDefs->internalcomment)) {
                $matter->internalcomment = $matDefs->internalcomment;
            }
            if (isset($matDefs->accountcomment)) {
                $matter->accountcomment = $matDefs->accountcomment;
            }
            if (isset($matDefs->clientfeesheetid)) {
                $matter->clientfeesheetid = $matDefs->clientfeesheetid;
            }
            if (isset($matDefs->accountslanguageid)) {
                $matter->accountslanguageid = $matDefs->accountslanguageid;
            }
            if (isset($matDefs->feeestimate)) {
                $matter->feeestimate = $matDefs->feeestimate;
            }
            if (isset($matDefs->feenotesonhold)) {
                $matter->feenotesonhold = $matDefs->feenotesonhold;
            }
            if (isset($matDefs->interestrate)) {
                $matter->interestrate = $matDefs->interestrate;
            }
            if (isset($matDefs->scheduleid)) {
                $matter->scheduleid = $matDefs->scheduleid;
            }
            if (isset($matDefs->agentflag)) {
                $matter->agentflag = $matDefs->agentflag;
            }
            if (isset($matDefs->adminfeeflag)) {
                $matter->adminfeeflag = $matDefs->adminfeeflag;
            }
            if (isset($matDefs->interestflag)) {
                $matter->interestflag = $matDefs->interestflag;
            }
            if (isset($matDefs->vatexemptflag)) {
                $matter->vatexemptflag = $matDefs->vatexemptflag;
            }
            if (isset($matDefs->discountsurcharge)) {
                $matter->discountsurcharge = $matDefs->discountsurcharge;
            }
            if (isset($matDefs->receiptoption)) {
                $matter->receiptoption = $matDefs->receiptoption;
            }
            if (isset($matDefs->consolidateid)) {
                $matter->consolidateid = $matDefs->consolidateid;
            }
            if (isset($matDefs->consolidatedflag)) {
                $matter->consolidatedflag = $matDefs->consolidatedflag;
            }
            if (isset($matDefs->invoiceflag)) {
                $matter->invoiceflag = $matDefs->invoiceflag;
            }
            if (isset($matDefs->invoiceoption)) {
                $matter->invoiceoption = $matDefs->invoiceoption;
            }
            if (isset($matDefs->invoiceformat)) {
                $matter->invoiceformat = $matDefs->invoiceformat;
            }
            if (isset($matDefs->costcentreid)) {
                $matter->costcentreid = $matDefs->costcentreid;
            }
            if (isset($matDefs->overrideincomeaccflag)) {
                $matter->overrideincomeaccflag = $matDefs->overrideincomeaccflag;
            }
            if (isset($matDefs->incomeaccid)) {
                $matter->incomeaccid = $matDefs->incomeaccid;
            }
            if (isset($matDefs->trustbankid)) {
                $matter->trustbankid = $matDefs->trustbankid;
            }
            if (isset($matDefs->movementflag)) {
                $matter->movementflag = $matDefs->movementflag;
            }
            if (isset($matDefs->collcommflag)) {
                $matter->collcommflag = $matDefs->collcommflag;
            }
            if (isset($matDefs->collcommoption)) {
                $matter->collcommoption = $matDefs->collcommoption;
            }
            if (isset($matDefs->collcommpercent)) {
                $matter->collcommpercent = $matDefs->collcommpercent;
            }
            if (isset($matDefs->collcommlimit)) {
                $matter->collcommlimit = $matDefs->collcommlimit;
            }
            if (isset($matDefs->todogroupid)) {
                $matter->todogroupid = $matDefs->todogroupid;
            }
            if (isset($matDefs->businessbankid)) {
                $matter->businessbankid = $matDefs->businessbankid;
            }
            if (isset($matDefs->branchflag)) {
                $matter->branchflag = $matDefs->branchflag;
            }
            if (isset($matDefs->branchid)) {
                $matter->branchid = $matDefs->branchid;
            }
            if (isset($matDefs->consolidatedisbursementsflag)) {
                $matter->consolidatedisbursementsflag = $matDefs->consolidatedisbursementsflag;
            }
            if (isset($matDefs->investmentfeeflag)) {
                $matter->investmentfeeflag = $matDefs->investmentfeeflag;
            }
            if (isset($matDefs->debtorfeesheetid)) {
                $matter->debtorfeesheetid = $matDefs->debtorfeesheetid;
            }
            if (isset($matDefs->debtorcollcommoption)) {
                $matter->debtorcollcommoption = $matDefs->debtorcollcommoption;
            }
            if (isset($matDefs->debtorcollcommpercent)) {
                $matter->debtorcollcommpercent = $matDefs->debtorcollcommpercent;
            }
            if (isset($matDefs->debtorcollcommlimit)) {
                $matter->debtorcollcommlimit = $matDefs->debtorcollcommlimit;
            }
            if (isset($matDefs->matgroup)) {
                $matter->matgroup = $matDefs->matgroup;
            }
            if (isset($matDefs->receiptpercenttocosts)) {
                $matter->receiptpercenttocosts = $matDefs->receiptpercenttocosts;
            }
            if (isset($matDefs->agreedfeepercent)) {
                $matter->agreedfeepercent = $matDefs->agreedfeepercent;
            }
            if (isset($matDefs->payattorneyfirstamount)) {
                $matter->payattorneyfirstamount = $matDefs->payattorneyfirstamount;
            }
            if (isset($matDefs->coldebitfeecodeid)) {
                $matter->coldebitfeecodeid = $matDefs->coldebitfeecodeid;
            }
            if (isset($matDefs->defaultbillingrateid)) {
                $matter->defaultbillingrateid = $matDefs->defaultbillingrateid;
            }
            if (isset($matDefs->stagegroupid)) {
                $matter->stagegroupid = $matDefs->stagegroupid;
            }
            if (isset($matDefs->casetype)) {
                $matter->casetype = $matDefs->casetype;
            }
            if (isset($matDefs->actingfor)) {
                $matter->actingfor = $matDefs->actingfor;
            }
            if (isset($matDefs->courtflag)) {
                $matter->courtflag = $matDefs->courtflag;
            }
            if (isset($matDefs->defended)) {
                $matter->defended = $matDefs->defended;
            }
            if (isset($matDefs->attorneyclientflag)) {
                $matter->attorneyclientflag = $matDefs->attorneyclientflag;
            }
            if (isset($matDefs->courtdate)) {
                $matter->courtdate = $matDefs->courtdate;
            }
            if (isset($matDefs->invoicebfwdoption)) {
                $matter->invoicebfwdoption = $matDefs->invoicebfwdoption;
            }
            if (isset($matDefs->invoicefeeoption)) {
                $matter->invoicefeeoption = $matDefs->invoicefeeoption;
            }
            if (isset($matDefs->invoicedisbursementoption)) {
                $matter->invoicedisbursementoption = $matDefs->invoicedisbursementoption;
            }
            if (isset($matDefs->receiptamount)) {
                $matter->receiptamount = $matDefs->receiptamount;
            }
            if (isset($matDefs->commentoption)) {
                $matter->commentoption = $matDefs->commentoption;
            }
            if (isset($matDefs->bondcauseid)) {
                $matter->bondcauseid = $matDefs->bondcauseid;
            }
            if (isset($matDefs->matteremployeeid)) {
                $matter->matteremployeeid = $matDefs->matteremployeeid;
            }
            if (isset($matDefs->internalcommentoption)) {
                $matter->internalcommentoption = $matDefs->internalcommentoption;
            }
            if (isset($matDefs->agreedfeelimit)) {
                $matter->agreedfeelimit = $matDefs->agreedfeelimit;
            }
            if (isset($matDefs->excludeunitsonaccountflag)) {
                $matter->excludeunitsonaccountflag = $matDefs->excludeunitsonaccountflag;
            }
            if (isset($matDefs->receiptpercent)) {
                $matter->receiptpercent = $matDefs->receiptpercent;
            }
            if (isset($matDefs->showprescriptionwarningflag)) {
                $matter->showprescriptionwarningflag = $matDefs->showprescriptionwarningflag;
            }
        }
    }

    private function validateData($matter)
    {
        if (! isset($matter->clientid)) {
            throw new \Exception('Please specify the Client for this Matter');
        }

        if (! isset($matter->description)) {
            throw new \Exception('Please give the Matter a description.');
        }

        if (! isset($matter->clientfeesheetid)) {
            throw new \Exception('Please specify the Client Fee Sheet this Matter uses.');
        }

        if (! isset($matter->mattertypeid)) {
            throw new \Exception('Please specify the Matter Type for this Matter.');
        }

        if (! isset($matter->docgenid)) {
            throw new \Exception('Please specify the Document Set for this Matter.');
        }

        /*
            If MAT:AlternateRef
            CLEAR(ROW:Record)
            RowCounter{PROP:SQL} = 'Select 0,FileRef FROM Matter WHERE AlternateRef = ''' & MAT:AlternateRef & ''' AND RecordID <> ' & MAT:RecordID
            NEXT(RowCounter)
            IF ROW:Description
            MESSAGE('A Matter (' & ROW:Description & ') already has this Alternate Reference.','Duplicate Reference',ICON:Exclamation)
            SELECT(?)
            CYCLE
            END
        .
        OF ?MAT:FileRef
            If MAT:FileRef
                CLEAR(ROW:Record)
                RowCounter{PROP:SQL} = 'Select 0,Description FROM Matter WHERE FileRef = ''' & MAT:FileRef & ''' AND RecordID <> ' & MAT:RecordID
                NEXT(RowCounter)
                IF ROW:Description
                MESSAGE('A Matter with the Description ''' & ROW:Description & ''' already has this File Reference.','Duplicate File Reference',ICON:Exclamation)
                SELECT(?)
                CYCLE
                END
            .
        OF ?MAT:OldCode
            If MAT:OldCode
                CLEAR(ROW:Record)
                RowCounter{PROP:SQL} = 'Select 0,FileRef FROM Matter WHERE OldCode = ''' & MAT:OldCode & ''' AND RecordID <> ' & MAT:RecordID
                NEXT(RowCounter)
                IF ROW:Description
                MESSAGE('A Matter (' & ROW:Description & ') already has this Old Code.','Duplicate Old Code',ICON:Exclamation)
                SELECT(?)
                CYCLE
                END
            .

        */
    }

    private function sanitizeData(&$matter, $employeeId)
    {
        try {

            // **********************************
            // Set the Client Flag
            // **********************************
            party::where('recordid', $matter->clientid)
            ->update(['clientflag' => '1']);

            // ******************************************
            // Convert dates
            // ******************************************
            if (isset($matter->dateinstructed)) {
                $matter->dateinstructed = ModelHelper::convertClarionDate($matter->dateinstructed);
            }
            if (isset($matter->archivedate)) {
                $matter->archivedate = ModelHelper::convertClarionDate($matter->archivedate);
            }
            if (isset($matter->courtdate)) {
                $matter->courtdate = ModelHelper::convertClarionDate($matter->courtdate);
            }
            if (isset($matter->importantdate)) {
                $matter->importantdate = ModelHelper::convertClarionDate($matter->importantdate);
            }
            if (isset($matter->interestfrom)) {
                $matter->interestfrom = ModelHelper::convertClarionDate($matter->interestfrom);
            }
            if (isset($matter->prescriptiondate)) {
                $matter->prescriptiondate = ModelHelper::convertClarionDate($matter->prescriptiondate);
            }

            if (! isset($matter->consolidatedflag)) {
                $matter->consolidatedflag = 0;
                $matter->consolidateid = null;
            }

            // **********************************
            // Branch Flag
            // **********************************

            if (! isset($matter->branchflag)) {
                $matter->branchflag = 0;
                $matter->branchid = null;
            }

            if (! $matter->branchflag) {
                $matter->branchid = null;
            }

            if ($matter->branchid == '0') {
                $matter->branchflag = 0;
                $matter->branchid = null;
            }

            $matter->branchflag = $matter->branchid ? 1 : 0;

            // **********************************
            // Income Account
            // **********************************

            if (! isset($matter->overrideincomeaccflag)) {
                $matter->overrideincomeaccflag = 0;
                $matter->incomeaccid = null;
            }

            if ($matter->overrideincomeaccflag == '0') {
                $matter->incomeaccid = null;
            }

            $matter->overrideincomeaccflag = $matter->incomeaccid ? 1 : 0;

            if (! isset($matter->agreedfeeflag) || $matter->agreedfeeflag == 0) {
                $matter->agreedfeepercent = 0;
                $matter->agreedfeelimit = 0;
            }

            if (! isset($matter->receiptpercent)) {
                $matter->receiptpercent = '0.00';
            }
            if (! isset($matter->receiptamount)) {
                $matter->receiptamount = '0.00';
            }
            if (! isset($matter->claimamount)) {
                $matter->claimamount = '0.00';
            }

            $matter->debtorsopeningbalance = $matter->interestonamount = $matter->claimamount;

            if (! isset($matter->agreedfeepercent)) {
                $matter->agreedfeepercent = '0.00';
            }
            if (! isset($matter->agentpercent)) {
                $matter->agentpercent = '0.00';
            }

            if (! isset($matter->debtorpaymentfrequency)) {
                $matter->debtorpaymentfrequency = '1';
            }

            //********************************
            // Check ArchiveStatus
            //********************************
            if ($matter->archiveflag) {
                if ($matter->archivestatus != 2) {
                    $matter->archivestatus = 2;
                }
            } else {
                if ($matter->archivestatus > 1) {
                    $matter->archivestatus = 0;
                }
            }

            if (isset($matter->collcommoption) || isset($matter->debtorcollcommoption)) {
                $control = control::select(['collcommpercent', 'collcommlimit'])->first();
                if (! $control) {
                    throw new \Exception('An error was encountered getting the Control table. It is required to check the Matter data.');
                }

                if (isset($matter->collcommoption)) {
                    if ($matter->collcommoption == 'U') {
                        $matter->collcommpercent = $control->collcommpercent;
                        $matter->collcommlimit = $control->collcommlimit;
                    } elseif ($matter->collcommoption == 'N') {
                        $matter->collcommpercent = 0;
                        $matter->collcommlimit = 0;
                    }
                }
                if (isset($matter->debtorcollcommoption)) {
                    if ($matter->debtorcollcommoption == 'U') {
                        $matter->debtorcollcommpercent = $control->collcommpercent;
                        $matter->debtorcollcommlimit = $control->collcommlimit;
                    } elseif ($matter->collcommoption == 'N') {
                        $matter->debtorcollcommpercent = 0;
                        $matter->debtorcollcommlimit = 0;
                    }
                }
            }

            if ($this->isCollectionsMatter($matter)) {
                if (! isset($matter->debtorfeesheetid)) {
                    $magCourtFeeSheet = \App\GenericTableModels\feesheet::select(['recordid'])
                    ->whereRaw('Description LIKE \'Mag%\' AND type = \'F\'')
                    ->first();

                    if ($magCourtFeeSheet) {
                        $matter->debtorfeesheetid = $magCourtFeeSheet->recordid;
                    }
                }

                if (! isset($matter->interestrate)) {
                    if (isset($matter->documentlanguageid)) {
                        $colDefs = \App\GenericTableModels\coldef::select(['interestrate'])
                        ->where('EmployeeID', $employeeId)
                        ->where('LanguageID', $matter->documentlanguageid)
                        ->first();

                        if ($colDefs) {
                            $matter->interestrate = $colDefs->interestrate;
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function addSiblingTables($matter)
    {
        try {
            $colDataExists = coldata::where('MatterID', $matter->recordid)->exists();

            if (! $colDataExists) {
                $colData = new \stdClass();
                $colData->matterid = $matter->recordid;

                $colData->casetype = 'Act';
                $colData->actingfor = 'P';
                $colData->courtflag = 'M';
                $colData->defended = 'U';
                $colData->attorneyclientflag = 0;
                $colData->interestendamount = 0;

                $recordid = coldata::max('recordid');
                $colData->recordid = $recordid + 1;

                $returnData = coldata::create((array) $colData);
            }

            $bondDataExists = bonddata::where('MatterID', $matter->recordid)->exists();

            if (! $bondDataExists) {
                $bondData = new \stdClass();
                $bondData->matterid = $matter->recordid;

                bonddata::create((array) $bondData);
            }

            $conveyDataExists = conveydata::where('MatterID', $matter->recordid)->exists();

            if (! $conveyDataExists) {
                $conveyData = new \stdClass();
                $conveyData->matterid = $matter->recordid;

                //30/01/2015 Sameer: Prime CONV:SBSA_PRODUCE_NEW_CLF_DOCS field when creating a matter
                $conveyData->sbsa_produce_new_clf_docs = 'N';

                conveydata::create((array) $conveyData);
            }
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function addMatterEmployee($matter)
    {
        try {
            $record = new \stdClass();
            $record->matterid = $matter->recordid;
            $record->employeeid = $matter->employeeid;

            matemployee::create((array) $record);
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function addMatterParties($matter)
    {
        try {
            $control = control::select(['clientroleid', 'sellerroleid', 'mortgagorroleid', 'plaintiffroleid'])->first();
            if (! $control) {
                throw new \Exception('An error was encountered getting the Control table. It is required to add the default Parties to the Matter.');
            }

            $client = new \stdClass();
            $client->sorter = 1;
            $client->matterid = $matter->recordid;
            $client->roleid = $control->clientroleid;
            $client->partyid = $matter->clientid;
            $client->contactid = $this->getDefaultContact($matter->clientid);
            $client->languageid = $this->getDefaultPartyLanguage($matter->clientid);
            $client->reference = isset($matter->theirref) ? $matter->theirref : null;

            $recordid = matparty::max('recordid');
            $client->recordid = $recordid + 1;

            matparty::create((array) $client);

            if ($this->isCollectionsMatter($matter)) {
                $plaintiff = $client;
                $plaintiff->roleid = $control->plaintiffroleid;
                $plaintiff->recordid = $client->recordid + 1;
                matparty::create((array) $plaintiff);
            } elseif ($this->isTransfersMatter($matter)) {
                $seller = $client;
                $seller->roleid = $control->sellerroleid;
                $seller->recordid = $client->recordid + 1;
                matparty::create((array) $seller);
            } elseif ($this->isBondMatter($matter)) {
                $mortgagor = $client;
                $mortgagor->roleid = $control->mortgageeroleid;
                $mortgagor->recordid = $client->recordid + 1;
                matparty::create((array) $mortgagor);
            } elseif ($this->isSectionalTitleRegisterMatter($matter)) {
                $mortgagor = $client;
                $mortgagor->roleid = $control->developerroleid;
                $mortgagor->recordid = $client->recordid + 1;
                matparty::create((array) $mortgagor);
            }
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function getDefaultContact($partyId)
    {
        //'Select OtherPartyID From ParRel WHERE PartyID = ' & ThePartyID & ' AND DefaultContactFlag = 1'

        $parRel = \App\GenericTableModels\parrel::select('OtherPartyID')
        ->where('PartyID', $partyId)
        ->where('DefaultContactFlag', 1)
        ->first();

        return $parRel ? $parRel->OtherPartyID : null;
    }

    private function getDefaultPartyLanguage($partyId)
    {
        //Select DefaultLanguageID From Party WHERE RecordID = ' & ThePartyID

        $party = party::select('DefaultLanguageID')
        ->where('RecordID', $partyId)
        ->first();

        return $party ? $party->DefaultLanguageID : 1;
    }

    private function setMatterFileRef(&$matter, $matterPrefix, $matterPrefixOption)
    {
        try {
            $fileRefCounterStatement = 'SELECT ISNULL(max(Convert(Int,FileRef)),0) as counter from (';
            $fileRefCounterStatement .= 'Select case when charindex(\'/\',fileref) > 1 Then ';
            $fileRefCounterStatement .= 'SubString(case when charindex(\'-\',fileref,charindex(\'/\',fileref)) > 1 Then SubString(fileref,1,charindex(\'-\',fileref,charindex(\'/\',fileref))-1) Else FileRef end ';
            $fileRefCounterStatement .= ',charindex(\'/\',fileref)+1,14) Else \'\' End FileRef ';
            $fileRefCounterStatement .= 'from matter where fileref like \'';
            $fileRefCounterStatement .= $matterPrefix;
            $fileRefCounterStatement .= '/%\' and ';
            $fileRefCounterStatement .= 'fileref not like \'';
            $fileRefCounterStatement .= $matterPrefix;
            $fileRefCounterStatement .= '/99999%\' ) A ';
            $fileRefCounterStatement .= 'where Isnumeric(FileRef) <> 0';

            $query = DB::connection('sqlsrv')->select($fileRefCounterStatement);

            $counter = (int) $query[0]->counter;

            $counter++;

            if ((int) $matterPrefixOption >= 1) {
                if ($counter < 100000) {

                    //https://www.delftstack.com/howto/php/how-to-properly-format-a-number-with-leading-zeros-in-php/
                    $matter->fileref = $matterPrefix.'/'.substr(str_repeat(0, 5).$counter, -5);
                } else {
                    $matter->fileref = $matterPrefix.'/'.$counter;
                }
            } else {
                if ($counter < 10000) {
                    $matter->fileref = $matterPrefix.'/'.substr(str_repeat(0, 4).$counter, -4);
                } else {
                    $matter->fileref = $matterPrefix.'/'.$counter;
                }
            }
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function checkOldCode($matter)
    {
        try {
            if (isset($matter->oldcode)) {
                $duplicateMatter = matter::select(['FileRef'])
                ->where('OldCode', $matter->oldcode)
                ->where('RecordId', '<>', $matter->recordid)
                ->first();

                if ($duplicateMatter) {
                    throw new \Exception('<p>A Matter ('.$duplicateMatter->FileRef.') already has this Old Code ('.$matter->oldcode.')</p><p>The Old Code must be unique.</p>');
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function checkAlternateRef($matter)
    {
        try {
            if (isset($matter->alternateref)) {
                $duplicateMatter = matter::select(['FileRef'])
                ->where('AlternateRef', $matter->alternateref)
                ->where('RecordId', '<>', $matter->recordid)
                ->first();

                if ($duplicateMatter) {
                    throw new \Exception('<p>A Matter ('.$duplicateMatter->FileRef.') already has this Alternate Reference ('.$matter->alternateref.')</p><p>The Alternate Reference must be unique.</p>');
                }
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function checkArchiveNumber($matter)
    {
        try {
            if ($matter->archivestatus == '2') {
                if ($matter->actual > 0 ||
                    $matter->reserved > 0 ||
                    $matter->invested > 0 ||
                    $matter->transfer > 0 ||
                    $matter->batchednormal > 0 ||
                    $matter->batchedreserved > 0 ||
                    $matter->batchedinvested > 0) {
                    $matter->archiveflag = '0';
                    $matter->archivestatus = '1';
                    throw new \Exception('<p>You cannot archive a Matter if any of these balances (Actual, Reserved, Invested, Transfer or Batched) are not zero.</p><p>This matter will be set to "Pending".</p><p>The Matter will then be archived at Period-End if all balances are zero and there are no outstanding Invoices.</p>');
                } elseif (($matter->consolidatedflag == '1' || $matter->consolidatedflag == '2') &&
                    ($matter->actual != 0 ||
                    $matter->reserved != 0 ||
                    $matter->totalfees != 0 ||
                    $matter->totaldisbursements != 0 ||
                    $matter->totalreceipts != 0 ||
                    $matter->totalpayments != 0 ||
                    $matter->totaljournal != 0)
                ) {
                    $matter->archiveflag = '0';
                    $matter->archivestatus = '1';
                    throw new \Exception('<p>You cannot archive a Matter that is marked for Consolidation and still has balances.</p><p>This matter will be set to "Pending".</p><p>The Matter will then be archived at Period-End if all balances are zero and there are no outstanding Invoices.</p>');
                } elseif ($matter->createinvoiceflag == '1' && $matter->invoiceFlag == '1') {
                    $matter->archiveflag = '0';
                    $matter->archivestatus = '1';
                    throw new \Exception('<p>You cannot archive a Matter if there is an outstanding Invoice||Either create an invoice for this Matter or mark this Matter as "Do Not Create Invoice"</p><p>This matter will be set to "Pending".</p><p>The Matter will then be archived at Period-End if all balances are zero and there are no outstanding Invoices.</p>');
                } else {
                    $matter->archiveflag = '1';
                }
            }

            if ($matter->archiveno && (int) $matter->archiveno > 0) {
                $duplicateArchivedMatter = matter::select(['FileRef'])
                ->where('ArchiveNo', $matter->archiveno)
                ->where('RecordId', '<>', $matter->recordid)
                ->first();

                if ($duplicateArchivedMatter) {
                    $matter->archiveno = $this->getNextArchiveNo();
                }
            } else {
                if ($matter->archiveflag) {
                    if (! $matter->archivedate) {
                        $matter->archivedate = ModelHelper::convertClarionDate(date('Y-m-d'));
                    }

                    $matter->archiveno = $this->getNextArchiveNo();
                }
            }

            if ($matter->archiveflag) {
                if (! $matter->archivedate) {
                    $matter->archivedate = ModelHelper::convertClarionDate(date('Y-m-d'));
                }
            } else {
                $matter->archivedate = null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        /*If CTL:LastArchiveId = 0 Then Exit.
        If MAT:ArchiveNo <= 0 Then Exit.
        RowCounter{PROP:SQL} = 'select recordid, FileRef from matter where archiveno = ' & MAT:ArchiveNo
        Next(RowCounter)
        If ROW:Counter and ROW:Counter <> MAT:RecordId
            Message('This number has already been used by another matter|FileRef: ' & ROW:Description & 'Setting archive number to next available number',ICON:Asterisk)
            MAT:ArchiveNo = GetNextArchiveNo()
        .*/
    }

    private function getNextArchiveNo()
    {
        try {
            $returnValue = 0;

            $maxArchiveNumber = (int) matter::max('archiveno');

            if ($maxArchiveNumber < 0) {
                $maxArchiveNumber = 0;
            }

            $returnValue = $maxArchiveNumber + 1;

            $control = control::select(['recordid', 'lastArchiveId'])->first();

            if ($control) {
                $lastArchiveId = (int) $control->lastArchiveId;

                if ($lastArchiveId < $returnValue) {
                    $lastArchiveId = $returnValue;
                } elseif ($lastArchiveId >= $returnValue) {
                    $lastArchiveId += 1;
                    $returnValue = $lastArchiveId;
                }

                control::where('recordid', $control->recordid)
                ->update(['lastArchiveId' => $lastArchiveId]);
            } else {
                throw new \Exception('Could not get the Control file to set the lastArchiveId');
            }

            return $returnValue;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function checkConsolidation($matter)
    {
        try {
            $returnError = '';

            if ($matter->consolidateid) {
                $consolidatedMatter = matter::select(['FileRef', 'ConsolidateId', 'ConsolidatedFlag'])->where('RecordId', $matter->consolidateid)->first();

                if ($consolidatedMatter) {
                    if ($consolidatedMatter->ConsolidateId) {
                        $returnError = '<p>You cannot consolidate this Matter with '.$consolidatedMatter->FileRef.'.</p><p>It is consolidated to another Matter.</p><p>You can only consolidate this Matter with a Matter that is not already consolidated.</p>';
                    } elseif ($consolidatedMatter->ConsolidatedFlag !== '4') {
                        $returnError = '<p>You cannot consolidate this Matter with '.$consolidatedMatter->FileRef.'.</p><p>It is not a "Consolidated Account".</p>';
                    }
                } else {
                    $returnError = '<p>Could not find Consolidation Matter (RecordID: '.$matter->consolidateid.')</p>';
                }
            }

            if ($returnError) {
                throw new \Exception($returnError);
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    private function getDocgen(&$matter)
    {

        // ##ROSS Docgen class not auto loaded -fix: Either Docgen OR DocGen!!!!!!!!!!!!!!!!
        try {
            $docgen = docgen::select(['type', 'code', 'description'])->where('RecordID', $matter->docgenid)->firstOrFail();

            $matter->docgentype = $docgen->type;
            $matter->docgencode = $docgen->code;
            $matter->docgendescription = $docgen->description;
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    private function isCollectionsMatter($matter)
    {
        if (! isset($matter->docgentype)) {
            $this->getDocgen($matter);
        }

        return $matter->docgentype == 'LIT' && $matter->docgencode != 'AMO' ? true : false;
    }

    private function isBondMatter($matter)
    {
        if (! isset($matter->docgentype)) {
            $this->getDocgen($matter);
        }

        return $matter->docgentype == 'BON' ? true : false;
    }

    private function isSectionalTitleRegisterMatter($matter)
    {
        if (! isset($matter->docgentype)) {
            $this->getDocgen($matter);
        }

        return $matter->docgentype == 'STR' ? true : false;
    }

    private function isTransfersMatter($matter)
    {
        if (! isset($matter->docgentype)) {
            $this->getDocgen($matter);
        }

        return $matter->docgentype == 'TRN' ? true : false;
    }

    private function isConveyancingMatter($matter)
    {
        if (! isset($matter->docgentype)) {
            $this->getDocgen($matter);
        }

        return $matter->docgentype == 'BON' || $matter->docgentype == 'TRN' ? true : false;
    }
}
