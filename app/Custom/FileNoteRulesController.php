<?php

namespace App\Custom;

use App\GenericTableModels\control;
use App\GenericTableModels\feenote;
use App\GenericTableModels\filenote;
use App\GenericTableModels\matter;
use App\GenericTableModels\stage;
use App\GenericTableModels\todonote;
use Illuminate\Support\Facades\DB;

class FileNoteRulesController
{
    public function storeRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = filenote::create((array) $record);

            $record->recordid = $returnData->recordid;

            $this->addReminder($record);

            $this->addFeeNote($record);

            return $returnData;
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    public function updateRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = filenote::findOrFail($record->recordid);

            unset($record->recordid);

            $returnData->update((array) $record);

            $this->addReminder($record);

            $this->addFeeNote($record);

            return $returnData;
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    private function addReminder($record)
    {
        if (isset($record->createreminderflag) && isset($record->createreminderdescription) && isset($record->createreminderdays)) {
            if ($record->createreminderflag == '1') {
                $todoNote = new \stdClass();

                // To Do
                //TOD:Date = CheckHoliday(TOD:Date)

                $today = \Carbon\Carbon::today();

                $reminderDate = $today->addDays((int) $record->createreminderdays);

                $reminderDate = Utils::getNextWorkingDay($reminderDate);

                $todoNote->date = (int) \App\Custom\ModelHelper::convertClarionDate($reminderDate);

                $todoNote->matterid = $record->matterid;
                $todoNote->employeeid = $record->employeeid;
                $todoNote->description = $record->createreminderdescription;

                todonote::create((array) $todoNote);
            }
        }
    }

    private function addFeeNote($record)
    {

        // logger('$record->createfeenoteflag',[$record->createfeenoteflag]);
        // logger('$record->createfeenoteflag',[$record->createfeenotedescription]);
        // logger('$record->createfeenoteflag',[$record->createfeenoteamount]);

        if (isset($record->createfeenoteflag) && isset($record->createfeenotedescription) && isset($record->createfeenoteamount)) {
            if ($record->createfeenoteflag == '1') {
                if (! isset($record->source)) {
                    throw new \Exception('Please specify the Source - It is required to create the Fee Note.');
                }

                $feeNote = new \stdClass();

                $feeNote->date = $record->date;

                // Get Income Account
                $utilsController = new \App\Http\Controllers\UtilsController;
                $utilsRequest = new \Illuminate\Http\Request;
                $utilsRequest->matterid = $record->matterid;
                $result = json_decode($utilsController->getIncomeAccount($utilsRequest));

                $feeNote->code2 = $result->data->recordid;

                $matter = matter::select(['EmployeeId', 'CostCentreId', 'VatExemptFlag'])->where('RecordID', $record->matterid)->first();
                if (! $matter) {
                    throw new \Exception('An error was encountered getting the VatExemptFlag from the Matter.');
                }

                $utilsRequest->employeeid = $matter->EmployeeId;
                $feeNote->costcentreid = $matter->CostCentreId;

                $feeNote->postedflag = 0;
                $feeNote->source = $record->source;
                $feeNote->documentid = 0;
                $feeNote->partyid = 0;

                $feeNote->sorter = 0; // This is added by the Stored Procedure

                $feeNote->netamount = $feeNote->amount = $record->createfeenoteamount;

                $feeNote->netamount = $feeNote->amount = $record->createfeenoteamount;

                $feeNote->vatie = 'E';

                // Get the Vat Rate
                $control = control::select('VatMethod')->first();
                if (! $control) {
                    throw new \Exception('An error was encountered getting the VatMethod from the Control table.');
                }

                if ($matter->VatExemptFlag == '1') {
                    $feeNote->vatrate = 'E';
                } elseif ($matter->VatExemptFlag == '2') {
                    $feeNote->vatrate = 'Z';
                } elseif ($control->VatMethod == 'N') {
                    $feeNote->vatrate = 'N';
                } else {
                    $feeNote->vatrate = '1';
                }

                $feeNote->option1 = 1;
                $feeNote->type1 = 'F';
                $feeNote->matterid = $record->matterid;
                $feeNote->employeeid = $record->employeeid;
                $feeNote->description = $record->createfeenotedescription;

                feenote::create((array) $feeNote);
                // $result = feenote::create( (array) $feeNote);

                // logger('$result',[$result]);
            }
        }
    }

    private function validateData($record)
    {
        if (! isset($record->date)) {
            throw new \Exception('Please specify the Date of the File Note.');
        }

        if (! isset($record->time)) {
            throw new \Exception('Please specify the Time of the File Note.');
        }

        if (! isset($record->employeeid)) {
            throw new \Exception('Please specify the Employee this File Note is assigned to.');
        }

        if (! isset($record->createddate)) {
            throw new \Exception('Please specify the Date the File Note was created.');
        }

        if (! isset($record->createdtime)) {
            throw new \Exception('Please specify the Time the File Note was created.');
        }

        if (! isset($record->createdby)) {
            throw new \Exception('Please specify the Employee who created the File Note.');
        }

        if (! isset($record->matterid)) {
            throw new \Exception('Please specify the Matter this File Note belongs to.');
        }

        $matter = matter::select(['archiveflag'])->where('RecordID', $record->matterid)->first();
        if (! $matter) {
            throw new \Exception('An error was encountered getting the Matter.');
        }

        if ($matter->archiveflag == '1') {
            throw new \Exception('This Matter is Archived. You cannot modify an Archived Matter');
        }

        if (! isset($record->description) || empty($record->description)) {
            throw new \Exception('Please give the File Note a description.');
        }

        if (isset($record->stageid) && $record->stageid != '0') {
            $stage = stage::select(['conditionOption', 'condition'])->where('RecordID', $record->stageid)->first();

            if (! $stage) {
                throw new \Exception('An error was encountered getting the Stage table. It is required to check the Stage conditions.');
            }

            if (isset($stage->condition) && isset($stage->conditionOption)) {
                $statement = 'Select Count(1) as counter From (Select Distinct Stage.Code From FileNote';
                $statement .= ' Inner join Stage On Stage.RecordID = FileNote.StageID';
                $statement .= ' Where MatterId = ';
                $statement .= $record->matterid;
                $statement .= ' And Stage.Code in (';
                $statement .= $stage->condition;
                $statement .= ') ) A';

                $query = DB::connection('sqlsrv')->select($statement);

                $counter = (int) $query[0]->counter;

                if ($counter > 0) {
                    throw new \Exception('You cannot capture this Stage yet. These Stages must be completed first: '.$stage->condition);
                }
            }
        }

        /*

        $createreminderdays = '7'

        $todoNote = new \stdClass();

        $today = \Carbon\Carbon::today();

        $reminderDate = $today->addDays( (int) $createreminderdays);

        if ( $reminderDate->isWeekend() ) $reminderDate->addDays(1);
        if ( $reminderDate->isWeekend() ) $reminderDate->addDays(1);

        $todoNote->date = (int) \App\Custom\ModelHelper::convertClarionDate($reminderDate);

        $todoNote->matterid = 71017;
        $todoNote->employeeid = 5;
        $todoNote->description = 'Test Adding Reminder from FileNote';

        \App\GenericTableModels\todonote::create( (array) $todoNote);








        use App\GenericTableModels\stage;
        $stageid = '506';
        $matterid = '71335';

        $stage = stage::select(['conditionOption','condition'])->where('RecordID',$stageid)->first();

        if ( isset($stage->condition) ) {

        $statement = 'Select Count(1) as counter From (Select Distinct Stage.Code From FileNote';
        $statement .= ' Inner join Stage On Stage.RecordID = filenote.StageID' ;
        $statement .= ' Where MatterId = ' ;
        $statement .= $matterid;
        $statement .= ' And Stage.Code in (';
        $statement .= $stage->condition ;
        $statement .= ') ) A';

        $query = DB::connection('sqlsrv')->select($statement);

        $counter = (int) $query[0]->counter;
        }

        */
    }
}
