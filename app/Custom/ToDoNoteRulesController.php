<?php

namespace App\Custom;

use App\Custom\ModelHelper;
use App\Custom\Utils;
use App\GenericTableModels\employee;
use App\GenericTableModels\filenote;
use App\GenericTableModels\matter;
use App\GenericTableModels\todoitem;
use App\GenericTableModels\todonote;
use Illuminate\Support\Facades\DB;

class ToDoNoteRulesController
{
    public function storeRecord($request)
    {
        try {

            //Convert the $request array into an object (for better syntax)
            $record = (object) $request;

            $this->validateData($record);

            $returnData = todonote::create((array) $record);

            $record->recordid = $returnData->recordid;

            if (isset($record->datedone)) {
                $this->processCompletedReminder($request, $record);
            }

            //logger('$returnData for ToDoNoteRulesController storeRecord',[$returnData]);

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

            $returnData = todonote::findOrFail($record->recordid);

            // Tinker
            //$returnData = \App\GenericTableModels\todonote::findOrFail(242309);

            $thisDateDone = (int) $record->datedone;
            $previousDateDone = (int) $returnData->DateDone;

            unset($record->recordid);

            $returnData->update((array) $record);

            if ($thisDateDone > 0) {

                // Reminder completed for the FIRST time
                if ($previousDateDone == 0) {
                    $this->processCompletedReminder($request, $record);
                }

                /* NOT SURE ABOUT THIS CODE - SHOULD IT ONLY EXECUTE IF DATEDONE IS DIFFERENT?*/
                if (isset($record->todoitemid)) {
                    $todoitem = todoitem::select('CriticalStep')->where('RecordID', $record->todoitemid)->first();

                    if ($todoitem) {
                        $this->updateConveyancingFlags($record, $todoitem->CriticalStep);
                        $this->updateCriticalSteps($record, $todoitem->CriticalStep);
                    }
                }
            }

            /* ONLY EXECUTE IF DATEDONE IS DIFFERENT
            if ( $thisDateDone > 0 ) {

                if ( $thisDateDone <> $previousDateDone ) {

                    $this->processCompletedReminder($request, $record);

                    if ( isset($record->todoitemid) ) {

                        $todoitem = todoitem::select('CriticalStep')->where('RecordID',$record->todoitemid)->first();

                        if ( $todoitem ) {

                            $this->updateConveyancingFlags($record, $todoitem->CriticalStep);

                        }

                    }


                } else {

                    if ( isset($record->todoitemid) ) {

                        $todoitem = todoitem::select('CriticalStep')->where('RecordID',$record->todoitemid)->first();

                        if ( $todoitem ) {

                            $this->updateConveyancingFlags($record, $todoitem->CriticalStep);
                            $this->updateCriticalSteps($record, $todoitem->CriticalStep);

                        }

                    }

                }
            }*/

            return $returnData;
        } catch (\Exception $e) {
            $returnData['errors'] = $e->getMessage();

            return $returnData;
        }
    }

    private function processCompletedReminder($request, $record)
    {

        // **********************************************
        // Add Recurring Reminder
        // **********************************************
        if ($record->recurringflag == '1') {
            $dateDone = \Carbon\Carbon::parse(Utils::stringFromClarionDate($record->datedone));

            if ($record->recurringperiod == 'Daily') {
                $newReminderDate = $dateDone->addDays(1);
            } elseif ($record->recurringperiod == 'Weekly') {
                $newReminderDate = $dateDone->addWeeks(1);
            } elseif ($record->recurringperiod == 'Fortnightly') {
                $newReminderDate = $dateDone->addWeeks(2);
            } elseif ($record->recurringperiod == 'Monthly') {
                $newReminderDate = $dateDone->addMonths(1);
            } elseif ($record->recurringperiod == 'Bi-Monthly') {
                $newReminderDate = $dateDone->addMonths(2);
            } elseif ($record->recurringperiod == '6-Months') {
                $newReminderDate = $dateDone->addMonths(6);
            } elseif ($record->recurringperiod == 'Yearly') {
                $newReminderDate = $dateDone->addYears(1);
            } elseif ($record->recurringperiod == 'Custom') {
                if ($record->recurringcustomtype == 'Days') {
                    $newReminderDate = $dateDone->addDays($record->recurringcustomamount);
                } elseif ($record->recurringcustomtype == 'Weeks') {
                    $newReminderDate = $dateDone->addWeeks($record->recurringcustomamount);
                } elseif ($record->recurringcustomtype == 'Months') {
                    $newReminderDate = $dateDone->addMonths($record->recurringcustomamount);
                } elseif ($record->recurringcustomtype == 'Years') {
                    $newReminderDate = $dateDone->addYears($record->recurringcustomamount);
                }
            }

            if (isset($newReminderDate)) {
                $todoNote = $record;

                $todoNote->date = ModelHelper::convertClarionDate($newReminderDate);

                $todoNote->date = Utils::getNextWorkingDay($todoNote->date);

                $todoNote->datedone = 0;
                $todoNote->completedflag = 0;
                $todoNote->completedbyid = 0;
                $todoNote->completedbynotes = '';

                todonote::create((array) $todoNote);
            }
        }

        // **********************************************
        // Add File Note
        // **********************************************
        $employee = employee::select(['ToDoNoteToFileNote', 'FileNotesInternalFlag'])->where('RecordID', $request['loggedinemployeeid'])->first();

        if (! $employee) {
            throw new \Exception('An error was encountered getting the logged in Employee record.');
        }

        if ($employee->ToDoNoteToFileNote == '1') {
            date_default_timezone_set('Africa/Johannesburg');

            $todaysDate = ModelHelper::convertClarionDate(date('Y-m-d'));

            $fileNote = new \stdClass();
            $fileNote->createddate = $todaysDate;
            $fileNote->createdby = $request['loggedinemployeeid'];
            $fileNote->createdtime = ModelHelper::convertClarionTime(date('H:i:s'));
            $fileNote->date = $todaysDate;
            $fileNote->description = $record->description.' "Done"';
            $fileNote->matterid = $record->matterid;
            $fileNote->employeeid = $request['loggedinemployeeid'];
            $fileNote->internalflag = $employee->FileNotesInternalFlag;

            filenote::create((array) $fileNote);
        }
    }

    private function updateCriticalSteps($record, $criticalStep)
    {
        if ($criticalStep == '1') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step1Target = '.ModelHelper::convertClarionDate($record->date).' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '2') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step2Target = '.ModelHelper::convertClarionDate($record->date).', Step2Completed = '.ModelHelper::convertClarionDate($record->datedone).' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '3') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step3Target = '.ModelHelper::convertClarionDate($record->date).', Step3Completed = '.ModelHelper::convertClarionDate($record->datedone).' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '4') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step4Target = '.ModelHelper::convertClarionDate($record->date).', Step4Completed = '.ModelHelper::convertClarionDate($record->datedone).' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '5') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step5Target = '.ModelHelper::convertClarionDate($record->date).', Step5Completed = '.ModelHelper::convertClarionDate($record->datedone).' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '6') {
            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET Step6Target = '.ModelHelper::convertClarionDate($record->date).', Step6Completed = '.ModelHelper::convertClarionDate($record->datedone).' WHERE MatterID = '.$record->matterid);

            /*IF MESSAGE('The Target Date for Registration has been changed.||Do you want to run the Tasks associated with this Event (recommended)?|','Registration date Changed',ICON:Exclamation,BUTTON:Yes+BUTTON:No,BUTTON:Yes) = BUTTON:Yes
                ProcessSystemEvent(EVENT:TargetRegistrationDateChanged,TOD:MatterID)
            END*/
        }
    }

    private function updateConveyancingFlags($record, $criticalStep)
    {
        if ($criticalStep == '8') { // ENTOMOLOGIST CERTIFICATE RECEIVED

            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET EntomologistFlag = 1, EntomologistDate = '.$record->datedone.' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '9') { // ELECTRICAL COMPLIANCE CERTIFICATE RECEIVED

            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET ElectricalFlag = 1, ElectricalDate = '.$record->datedone.' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '35') {   // Plumbing COMPLIANCE CERTIFICATE RECEIVED

            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET PlumbingFlag = 1, PlumbingDate = '.$record->datedone.' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '36') {   // Gas COMPLIANCE CERTIFICATE RECEIVED

            DB::connection('sqlsrv')->statement('UPDATE ConveyData SET GasFlag = 1, GasDate = '.$record->datedone.' WHERE MatterID = '.$record->matterid);
        } elseif ($criticalStep == '4') {   // LODGED

            DB::connection('sqlsrv')->statement('UPDATE Matter SET ConveyancingStatusFlag = 3 WHERE RecordID = '.$record->matterid);
        } elseif ($criticalStep == '6') {   // REGISTERED

            DB::connection('sqlsrv')->statement('UPDATE Matter SET ConveyancingStatusFlag = 4 WHERE RecordID = '.$record->matterid);
        }
    }

    private function validateData($record)
    {

        // Check if loggedinemployeeid was sent as part of the $request
        if (! isset($record->loggedinemployeeid)) {
            throw new \Exception('The LoggedInEmployeeId was not specified. This is required to process the Reminders. Please set loggedinemployeeid to the RecordID of the logged in Employee.');
        }

        if (! isset($record->createdbyid)) {
            throw new \Exception('Please specify the Employee who created the Reminder.');
        }

        if (! isset($record->createddate)) {
            throw new \Exception('Please specify the Date the Reminder was created.');
        }

        if (! isset($record->createdtime)) {
            throw new \Exception('Please specify the Time the Reminder was created.');
        }

        if (! isset($record->date)) {
            throw new \Exception('Please specify the Target Date of the Reminder.');
        }

        if (! isset($record->employeeid)) {
            throw new \Exception('Please specify the Employee this Reminder is assigned to.');
        }

        if (! isset($record->matterid)) {
            throw new \Exception('Please specify the Matter this Reminder belongs to.');
        }

        $matter = matter::select(['archiveflag'])->where('RecordID', $record->matterid)->first();
        if (! $matter) {
            throw new \Exception('An error was encountered getting the Matter.');
        }

        if ($matter->archiveflag == '1') {
            throw new \Exception('This Matter is Archived. You cannot modify an Archived Matter');
        }

        if (! isset($record->description) || empty($record->description)) {
            throw new \Exception('Please give the Reminder a description.');
        }
    }
}
