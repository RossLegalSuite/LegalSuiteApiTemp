<?php

namespace App\Http\Controllers;

use App\Custom\ModelHelper;
use App\Custom\SelectAndJoinBuilder;
use App\Custom\Utils;
use App\GenericTableModels\loltagged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UtilsController extends Controller
{
    public function checkSecurity(Request $request)
    {
        /* Test in Tinker
        $controller = new \App\Http\Controllers\UtilsController;
        $request = new \Illuminate\Http\Request;
        $request['employeeid'] = "5";
        $request['employeeid'] = "6";
        $request['matterid'] = "71017";
        $request['description'] = "Browse - Address Book - Change";
        $request['description'] = "Matters - Update - Insert";
        $request['description'] = "Matters - Update - Delete";
        $request['description'] = "Matters - Update - Change";
        $controller->checkSecurity($request);

        */
        $returnData = new \stdClass();

        $returnData->data = '';
        $returnData->errors = '';

        if (! isset($request->employeeid)) {
            throw new \Exception('EmployeeId not specified');
        }
        if (! isset($request->description)) {
            throw new \Exception('SecProc description not specified');
        }

        $control = \App\GenericTableModels\control::select(['licencevaliduntil'])->first();
        if (! $control) {
            throw new \Exception('An error was encountered getting the Licence Valid Until date from the Control table.');
        }

        if ((int) $control->licencevaliduntil >= 90000) {
            throw new \Exception('Licence Valid Until Setting: You are not licenced to access this area of the program.');
        }

        $employee = \App\GenericTableModels\employee::select(['supervisorflag', 'secgroupid'])->where('RecordID', $request->employeeid)->first();
        if (! $employee) {
            throw new \Exception('An error was encountered getting the Employee.');
        }

        // Allow the Supervisor
        if ($employee->supervisorflag == '1') {
            $returnData->data = 'Employee is a Supervisor - Access is allowed';

            return json_encode($returnData);
        }

        if ($request->description == 'Matters - Update - Change' && isset($request->matterid)) {
            $matter = \App\GenericTableModels\matter::select(['access', 'employeeid'])->where('RecordID', $request->matterid)->first();
            if (! $matter) {
                throw new \Exception('An error was encountered getting the Matter.');
            }

            if ($matter->access == 'R') {
                if ($matter->employeeid != $request->employeeid) {
                    throw new \Exception('This is a Restricted Matter. It can only be viewed by the Owner of the Matter');
                }
            }
        }

        $secproc = \App\GenericTableModels\secproc::select('accessflag')->where('SecGroupID', $employee->secgroupid)->where('description', $request->description)->first();

        if ($secproc) {
            if ($secproc->accessflag != '1') {
                throw new \Exception('Your Security Settings do not allow you to access this area of the program.');
            } else {
                $returnData->data = 'User has access to this area of the program';
            }
        } else {
            $returnData->data = 'SecProc not found - Allowing access. Please check that the secproc description provided is correct';
        }

        return json_encode($returnData);
    }

    public function uploadDocumentToDoclog(Request $request)
    {

        // For use by 3rd party apps

        if (! isset($request->employeelogin)) {
            throw new \Exception("Please specify the Employee's login id.");
        }

        if (! isset($request->matterfileref)) {
            throw new \Exception('Please specify the File Ref of the Matter.');
        }

        if (! isset($request->description)) {
            throw new \Exception('Please specify a description of the object to be uploaded.');
        }

        if (! isset($request->filename)) {
            throw new \Exception('Please specify the File Name of the object.');
        }

        if (! isset($request->filecontents)) {
            throw new \Exception('Please specify the File Contents to be uploaded.');
        }

        $matter = \App\GenericTableModels\matter::select(['recordid'])->where('FileRef', $request->matterfileref)->first();
        if (! $matter) {
            throw new \Exception('An error was encountered getting the Matter.');
        }

        $employee = \App\GenericTableModels\employee::select(['recordid'])->where('LoginId', $request->employeelogin)->first();
        if (! $employee) {
            throw new \Exception('An error was encountered getting the Employee.');
        }

        $control = \App\GenericTableModels\control::select(['firmcode'])->first();
        if (! $control) {
            throw new \Exception('An error was encountered getting the Firm Code from the Control table.');
        }

        $doclogcategory = \App\GenericTableModels\doclogcategory::select(['recordid'])->whereRaw("description LIKE '%document%'")->orderBy('RecordID')->first();
        if (! $doclogcategory) {
            throw new \Exception('An error was encountered getting the categoryid from the DoclogCategory table.');
        }

        try {
            $returnData = new \stdClass();

            $cloudStorage = Storage::disk('af-south-1');

            $returnData->fileName = $request->filename;

            $path = strtolower($control->firmcode.'/'.$employee->recordid.'/'.$matter->recordid.'/uploads');

            $returnData->url = $cloudStorage->url($path.'/'.$returnData->fileName);

            $cloudStorage->put($path.'/'.$returnData->fileName, $request->filecontents, 'public');

            date_default_timezone_set('Africa/Johannesburg');

            $doclog = new \stdClass();
            $doclog->date = ModelHelper::convertClarionDate(date('Y-m-d'));
            $doclog->time = ModelHelper::convertClarionTime(date('H:i:s'));
            $doclog->description = $request->description;
            $doclog->matterid = $matter->recordid;
            $doclog->employeeid = $employee->recordid;
            $doclog->savedname = $returnData->fileName;
            $doclog->url = $returnData->url;
            $doclog->direction = 2; // Incoming
            $doclog->doclogcategoryid = $doclogcategory->recordid;

            \App\GenericTableModels\doclog::create((array) $doclog);

            return json_encode($returnData);
        } catch (\Exception $e) {
            $returnData->errors = $e->getMessage();
            //$returnData->errors = 'Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage();

            return json_encode($returnData);
        }
    }

    public function createDocumentUploadStoredProcedure()
    {

        // ROSS: ********************************************************
        // This must be called when the user registers for the first time
        // ROSS: ********************************************************

        /* Testing in Tinker
        $controller = new App\Http\Controllers\UtilsController;$controller->createDocumentUploadStoredProcedure();
        */

        // Enable xp_cmdshell and OLE automation (only needs to be done once)
        DB::connection('sqlsrv')->statement("EXEC sp_configure 'xp_cmdshell', 1");
        DB::connection('sqlsrv')->statement("EXEC sp_configure 'Ole Automation Procedures', 1");

        // Create the sp_UploadDocument Stored Procedure

        DB::connection('sqlsrv')->statement('DROP PROCEDURE IF EXISTS dbo.sp_UploadDocument');

        $storedProceduresPath = base_path().'/resources/stored_procedures/';

        $procedure = file_get_contents($storedProceduresPath.'sp_uploadDocument.sql');

        DB::connection('sqlsrv')->unprepared($procedure);
    }

    public function uploadDocument(Request $request, $recordId)
    {

        /* Testing in Tinker
        Has saved name
        --------------
        $controller = new App\Http\Controllers\UtilsController
        $request = new Illuminate\Http\Request;
        $recordId = 154650;
        $controller->uploadDocument($request, $recordId)

        No saved name
        -------------
        $controller = new App\Http\Controllers\UtilsController
        $request = new Illuminate\Http\Request;
        $recordId = 144797;
        $controller->uploadDocument($request, $recordId)

        */

        //https://stackoverflow.com/questions/52070741/laravel-model-sql-server-get-output-parameters-from-stored-procedure

        $response = DB::connection('sqlsrv')->select('EXEC sp_UploadDocument ?', [$recordId]);

        $result = $response[0];

        if (isset($result->error)) {
            $returnData['errors'] = $result->error;
        } else {
            if (isset($result->data)) {
                $returnData['data']['url'] = $result->data;
            } else {
                $returnData['data']['url'] = null;
            }
        }

        return json_encode($returnData);
    }

    public function getFileType(Request $request)
    {
        if (isset($request['filename'])) {
            $returnData['data']['type'] = Utils::getFileType($request['filename']);
            $returnData['data']['mimetype'] = Utils::getMimeType($request['filename']);
        } else {
            $returnData['errors'] = 'No filename provided';
        }

        return json_encode($returnData);
    }

    public function getMimeType(Request $request)
    {
        if (isset($request['filename'])) {
            $returnData['data'] = Utils::getMimeType($request['filename']);
        } else {
            $returnData['errors'] = 'No filename provided';
        }

        return json_encode($returnData);
    }

    public function getTagged(Request $request)
    {
        $returnData['data'] = loltagged::where('tableName', $request['tablename'])->where('employeeid', $request['employeeid'])->pluck('taggedId')->toArray();

        return json_encode($returnData);
    }

    public function addTagged(Request $request)
    {

        /* Laravel does not support storing records for tables with composite keys (like LolTagged)
        See: https://stackoverflow.com/questions/31415213/how-i-can-put-composite-keys-in-models-in-laravel-5

        // This DOESN'T work:
        $tableName = 'loltagged';
        $className = 'App\\GenericGenericTableModels\\' . strtolower($tableName);
        $model = new $className;
        $request = new Illuminate\Http\Request;
        $request['tablename'] = 'matter';$request['taggedid'] = 12345;$request['employeeid'] = 5
        $requestData = $request->all();
        $recordData = $model::create($requestData);

        // Workaround
        use Illuminate\Support\Facades\DB;
        $request = new Illuminate\Http\Request;
        $request['tablename'] = 'matter';$request['taggedid'] = 12345;$request['employeeid'] = 5
        $query = DB::connection('sqlsrv')->insert('INSERT INTO lolTagged ("tableName","employeeId","taggedId") values (?,?,?)',[$request['tablename'],$request['employeeid'],$request['taggedid']]);

        */

        $result = DB::connection('sqlsrv')->insert('INSERT INTO lolTagged ("tableName","employeeId","taggedId") values (?,?,?)', [$request['tablename'], $request['employeeid'], $request['taggedid']]);

        if (! $result) {
            $returnData['errors'] = 'An error occured tagging the record';
        } else {
            $returnData['data'] = $request->all();
        }

        return json_encode($returnData);
    }

    public function deleteTagged(Request $request)
    {
        $result = DB::connection('sqlsrv')->statement("DELETE lolTagged WHERE tableName = '{$request['tablename']}' AND employeeId = {$request['employeeid']} AND taggedId = {$request['taggedid']}");

        if (! $result) {
            $returnData['errors'] = 'An error occured deleting the tagged record';
        } else {
            $returnData['data'] = $request->all();
        }

        return json_encode($returnData);
    }

    public function deleteEmployeeTags(Request $request)
    {
        $result = DB::connection('sqlsrv')->statement("DELETE lolTagged WHERE employeeId = {$request['employeeid']}");

        if (! $result) {
            $returnData['errors'] = 'An error occured deleting the Employee tags';
        } else {
            $returnData['data'] = $request->all();
        }

        return json_encode($returnData);
    }

    public function clearTagged(Request $request)
    {
        $result = DB::connection('sqlsrv')->statement("DELETE lolTagged WHERE tableName = '{$request['tablename']}' AND employeeId = {$request['employeeid']}");

        if (! $result) {
            $returnData['errors'] = 'An error occured tagging the record';
        } else {
            $returnData['data'] = $request->all();
        }

        return json_encode($returnData);
    }

    public function tagAll(Request $request)
    {
        $statement = 'INSERT INTO lolTagged (tableName, employeeId, taggedId) ';
        $statement .= "SELECT '{$request['tablename']}', '{$request['employeeid']}', {$request['tablename']}.RecordID FROM {$request['tablename']} ";

        if (method_exists(\App\Custom\SelectAndJoinBuilder::class, strtolower($request['tablename']).'JoinBuilder') & ! $request->removejoinbuilder) {

            // Use this hack to get the table joins in string format to add to the statement
            $query = DB::connection('sqlsrv')->table('dummy');

            SelectAndJoinBuilder::{strtolower($request['tablename']).'JoinBuilder'}($query);

            $dummySql = $query->toSql(); // Return select * from [dummy] left join ....

            $joinExpression = substr($dummySql, strpos($dummySql, ']') + 1);

            $statement .= $joinExpression;
        }

        $statement .= isset($request['whereraw']) ? ' WHERE '.$request['whereraw'] : '';

        $result = DB::connection('sqlsrv')->statement($statement);

        if (! $result) {
            $returnData['errors'] = 'An error occured tagging all the records';
        } else {
            $returnData['data'] = loltagged::where('tableName', $request['tablename'])->where('employeeid', $request['employeeid'])->pluck('taggedId')->toArray();
        }

        return json_encode($returnData);
    }

    public function getDebtorsAccount(Request $request)
    {
        $controller = new \App\Http\Controllers\DebtorsAccountController;

        return $controller->getDebtorsAccount($request);
    }

    public function getIncomeAccount(Request $request)
    {
        $returnData = new \stdClass();
        $returnData->data = [];
        $returnData->data['recordid'] = null;
        $returnData->data['overrideincomeaccflag'] = 0;

        if (! isset($request->matterid)) {
            throw new \Exception('getIncomeAccount - MatterId not specified');
        }

        if (! isset($request->employeeid)) {
            throw new \Exception('getIncomeAccount - EmployeeId not specified');
        }

        $matter = \App\GenericTableModels\matter::select(['incomeAccId', 'matterTypeID'])->where('RecordID', $request->matterid)->first();

        //Matter Has Overriding Income Account
        if ($matter->incomeAccId) {
            $returnData->data['recordid'] = $matter->incomeAccId;
        } else {
            $control = \App\GenericTableModels\control::select(['incomeAccOption', 'incomeAccId'])->first();

            // Use Control Income Account Setting
            if ($control->incomeAccOption == '0') {
                $returnData->data['recordid'] = $control->incomeAccId;

            // Use Employee Income Account Setting
            } elseif ($control->incomeAccOption == '1') {
                $employee = \App\GenericTableModels\employee::select('incomeAccId')->where('RecordID', $request->employeeid)->first();

                if (isset($employee->incomeAccId)) {
                    $returnData->data['recordid'] = $employee->incomeAccId;
                } else {
                    $returnData->data['recordid'] = $control->incomeAccId;
                    $returnData->data['overrideincomeaccflag'] = 1;
                }

                // Use Cost Centre Income Account Setting
            } elseif ($control->incomeAccOption == '2') {
                if (isset($request->costcentreid)) {
                    $costcentre = \App\GenericTableModels\costcentre::select('incomeAccId')->where('RecordID', $request->costcentreid)->first();

                    if (isset($costcentre->incomeAccId)) {
                        $returnData->data['recordid'] = $costcentre->incomeAccId;
                    } else {
                        $returnData->data['recordid'] = $control->incomeAccId;
                        $returnData->data['overrideincomeaccflag'] = 1;
                    }
                } else {
                    $returnData->data['recordid'] = $control->incomeAccId;
                    $returnData->data['overrideincomeaccflag'] = 1;
                }

                // Use Matter Type Income Account Setting
            } elseif ($control->incomeAccOption == '3') {
                $mattype = \App\GenericTableModels\mattype::select('incomeAccId')->where('RecordID', $matter->matterTypeID)->first();

                if (isset($mattype->incomeAccId)) {
                    $returnData->data['recordid'] = $mattype->incomeAccId;
                } else {
                    $returnData->data['recordid'] = $control->incomeAccId;
                    $returnData->data['overrideincomeaccflag'] = 1;
                }
            }
        }

        return json_encode($returnData);

        /*

        CLEAR(ROW:Record)
        RowCounter{PROP:SQL} = 'SELECT IncomeAccId FROM Matter WHERE RecordID = ' & TheMatterID
        NEXT(RowCounter)

        If ROW:Counter ! Matter Has Overriding Income Account

                LOC:ReturnValue = ROW:Counter

        ELSE
                Case CTL:IncomeAccOption
                Of 1
                EMP:RecordId = FN:EmployeeId
                Access:Employee.Fetch(EMP:PrimaryKey)

                RowCounter{PROP:SQL} = 'SELECT IncomeAccId FROM Employee WHERE RecordID = ' & TheEmployeeID
                NEXT(RowCounter)

                If ROW:Counter
                    LOC:ReturnValue = ROW:Counter
                Else
                    FN:OverrideIncomeAccFlag = 1
                    LOC:ReturnValue = CTL:IncomeAccId
                .
                Of 2
                COS:RecordId = FN:CostCentreId
                Access:CostCentre.Open
                Access:CostCentre.UseFile
                Access:CostCentre.Fetch(COS:PrimaryKey)
                If COS:IncomeAccId
                    LOC:ReturnValue = COS:IncomeAccId
                Else
                    FN:OverrideIncomeAccFlag = 1
                    LOC:ReturnValue = CTL:IncomeAccId
                .
                Access:CostCentre.Close
                Of 3
                RowCounter{PROP:SQL} = 'SELECT IncomeAccId FROM MatType WHERE RecordID = (Select MatterTypeID FROM Matter WHERE RecordID = ' & TheMatterID & ')'
                NEXT(RowCounter)

                If ROW:Counter
                    LOC:ReturnValue = ROW:Counter
                Else
                    FN:OverrideIncomeAccFlag = 1
                    LOC:ReturnValue = CTL:IncomeAccId
                .
                Of 0
                LOC:ReturnValue = CTL:IncomeAccId
                .
        END
        RETURN(LOC:ReturnValue)


        */
    }

    public function getCollCommPercentAndLimit(Request $request)
    {
        //getCollCommPercent   PROCEDURE  (LOC:Date)            ! Declare Procedure

        //PROPSQLNext('SELECT Commission FROM CommissionRate WHERE ' & LOC:Date & ' >= FromDate AND ' & LOC:Date & ' <= ToDate')
        //RETURN ROW:Counter

        $returnData = new \stdClass();
        $returnData->commission = null;
        $returnData->limit = null;

        $record = \App\GenericTableModels\commissionrate::select(['commission', 'limit'])
        ->whereRaw($request->date.' >= FromDate AND '.$request->date.' <= ToDate')
        ->first();

        // For testing purposes
        //$date = 70000;
        //\App\GenericTableModels\commissionrate::select(['commission','limit'])->whereRaw($date . ' >= FromDate AND ' . $date .' <= ToDate')->first();

        if ($record) {
            $returnData->commission = $record->commission;
            $returnData->limit = $record->limit;
        }

        return json_encode($returnData);
    }

    public function addFeeNotes(Request $request)
    {

/* Testing in Tinker
$controller = new App\Http\Controllers\UtilsController
$request = new Illuminate\Http\Request;

$feeitem = new \stdClass();

$feeitem->recordid = 18374;
$feeitem->employeeid = "5";
$feeitem->matterid = "71017";
$feeitem->costcentreid = "106";
$feeitem->date = "80746";
$feeitem->unitquantity = null;


$feeitem->feecodeid = "29";
$feeitem->description = "Acknoweldgment of Debt";
$feeitem->amount = "98.48";
$feeitem->netamount = "98.48";
$feeitem->sorter = "75";
$feeitem->maximumamount = ".00";
$feeitem->unitsflag = "0";
$feeitem->unitsid = "0";
$feeitem->factor = ".00";
$feeitem->activityflag = "1";
$feeitem->activityid = "1";
$feeitem->vatrate = "1";
$feeitem->vattypeflag = "E";
$feeitem->fromdate = "78220";
$feeitem->todate = "84009";
$feeitem->fromamount = null;
$feeitem->toamount = ".00";
$feeitem->option1 = "1";
$feeitem->attorneyclientflag = "0";
$feeitem->limitedby = "C";
$feeitem->alwaysusethisdescriptionflag = null;
$feeitem->defended = "N";
$feeitem->regionalcourtflag = null;
$feeitem->vatpercentage = "15.00";
$feeitem->formattedfromdate = "31 Dec 2030";
$feeitem->feesheetid = "3";
$feeitem->feecodedescription = "Acknowledgement Of Debt";
$feeitem->feesheettype = "F";
$feeitem->unitdescription = null;
$feeitem->unittimebasedflag = null;
$feeitem->unitcode = null;
$feeitem->unitminutesperunit = null;
$feeitem->activitydescription = "Drafting";
$feeitem->activitybillableflag = "1";
$feeitem->activityrate = null;
$feeitem->unitsingular = null;
$feeitem->unitplural = null;
$feeitem->feecodebusinessledgerid = "0";
$feeitem->feesheetbusinessledgerid = null;

$request->feeitems = array();
array_push($request->feeitems, $feeitem);

$controller->addFeeNotes($request);

*/

        if (! isset($request->source)) {
            throw new \Exception('Source not specified - The client application must provide a source');
        }
        if (! isset($request->feeitems)) {
            throw new \Exception('FeeItems not specified - An array of Fee Item records (feeitems[]) is required ');
        }

        $returnData = new \stdClass();

        foreach ($request->feeitems as $feeItem) {
            if (! isset($feeItem['matterid'])) {
                throw new \Exception('feeItem MatterID not specified - Each Fee Item record must have a MatterId');
            }
            if (! isset($feeItem['employeeid'])) {
                throw new \Exception('feeItem EmployeeID not specified - Each Fee Item record must have a EmployeeId');
            }
            if (! isset($feeItem['costcentreid'])) {
                throw new \Exception('feeItem CostCentreID not specified - Each Fee Item record must have a CostCentreId');
            }

            $feeNote = new \stdClass();

            $feeNote->sorter = 0; // The SQL trigger adds the RecordId as the Sorter (if sorter = 0)
            $feeNote->date = $feeItem['date'];
            $feeNote->description = $feeItem['description'];
            $feeNote->matterid = $feeItem['matterid'];
            $feeNote->employeeid = $feeItem['employeeid'];
            $feeNote->costcentreid = $feeItem['costcentreid'];

            $feeNote->postedflag = '0';
            $feeNote->source = $request->source;
            $feeNote->documentid = 0;
            $feeNote->partyid = 0;

            $feeNote->type1 = $feeItem['feesheettype'];

            $feeNote->feecodeid = $feeItem['feecodeid'];
            $feeNote->feeitemid = $feeItem['recordid'];

            $feeNote->vatie = $feeItem['vattypeflag'];
            $feeNote->vatrate = $feeItem['vatrate'];

            $feeNote->netamount = $feeItem['netamount'];
            $feeNote->amount = $feeItem['amount'];

            $feeNote->option1 = $feeItem['option1'];

            $feeNote->unitflag = isset($feeItem['unitsflag']) ? $feeItem['unitsflag'] : '0';
            $feeNote->unitid = isset($feeItem['unitsid']) ? $feeItem['unitsid'] : null;
            $feeNote->unitquantity = isset($feeNote->unitquantity) ? $feeItem['unitquantity'] : null;
            $feeNote->unittext = isset($feeNote->unitdescription) ? $feeItem['unitdescription'] : null;

            if ($feeNote->unitflag == '1' && isset($feeNote->unitquantity) && isset($feeNote->unittext)) {
                $control = \App\GenericTableModels\control::select('IncludeUnitsOnAccountFlag')->first();

                if ($control->IncludeUnitsOnAccountFlag == '1') {
                    $feeNote->description .= ' (';

                    if (\App\Custom\Utils::isDecimal($feeNote->unitquantity)) {
                        $feeNote->description .= (string) round($feeNote->unitquantity, 2).' '.$feeNote->unittext;
                    } else {
                        $feeNote->description .= $feeNote->unitquantity.' '.$feeNote->unittext;
                    }

                    $feeNote->description .= ')';
                }
            }

            // Set the Income Account
            if (isset($feeItem['feecodebusinessledgerid']) && (int) $feeItem['feecodebusinessledgerid'] > 0) {
                $feeNote->code2 = $feeItem['feecodebusinessledgerid'];
            } elseif (isset($feeItem['feesheetbusinessledgerid']) && (int) $feeItem['feesheetbusinessledgerid'] > 0) {
                $feeNote->code2 = $feeItem['feesheetbusinessledgerid'];
            } else {
                $utilsController = new self;
                $utilsRequest = new \Illuminate\Http\Request;

                $utilsRequest->matterid = $feeItem['matterid'];
                $utilsRequest->employeeid = $feeItem['employeeid'];

                $result = json_decode($utilsController->getIncomeAccount($utilsRequest));

                $feeNote->code2 = $result->data->recordid;

                /*
                $utilsController = new \App\Http\Controllers\UtilsController;
                $utilsRequest = new \Illuminate\Http\Request;
                $utilsRequest->matterid = '71017';
                $utilsRequest->employeeid = '5';
                $result = json_decode($utilsController->getIncomeAccount($utilsRequest));
                */
            }

            if (! isset($feeNote->code2)) {
                throw new \Exception('An error was encountered setting the Income Account of the Fee Note');
            }

            //$result = \App\GenericTableModels\feenote::create( (array) $feeNote);

            //$returnData->result = $result;
            //$returnData->data[] = $feeNote;
            $returnData->data[] = \App\GenericTableModels\feenote::create((array) $feeNote);
        }

        return json_encode($returnData);
    }

    public function getFeeItems(Request $request)
    {

/* Testing in Tinker
$controller = new App\Http\Controllers\UtilsController
$request = new Illuminate\Http\Request;
$request->matterid = 71017;
$request->languageid = 1;
$request->employeeid = 5;
$request->feecodes = '29';
$controller->getFeeItems($request);

*/

        $returnData = new \stdClass();

        if (! isset($request->matterid)) {
            throw new \Exception('MatterId not specified');
        }
        if (! isset($request->employeeid)) {
            throw new \Exception('EmployeeId not specified');
        }
        if (! isset($request->languageid)) {
            throw new \Exception('LanguageId not specified');
        }
        if (! isset($request->feecodes)) {
            throw new \Exception('Feecodes not specified - A comma separated list is required');
        }

        // Add the Linked FeeCodes
        $linkedFees = \App\GenericTableModels\feelink::whereIn('FeeCodeId', explode(',', $request->feecodes))->get()->toArray();

        foreach ($linkedFees as $linkedFee) {
            $request->feecodes .= (','.$linkedFee['LinkedCodeID']);
        }

        $todaysDate = ModelHelper::convertClarionDate(date('Y-m-d'));

        $genericController = new \App\Http\Controllers\GenericController;

        // Get the Matter
        $matterRequest = new \Illuminate\Http\Request;
        $matterResponse = $genericController->get($matterRequest, 'matter', $request->matterid);
        $matter = $matterResponse['data'][0];

        $defendedFlag = $regionalFlag = false;
        $claimAmount = isset($matter['claimamount']) ? (float) $matter['claimamount'] : 0;
        $salePrice = $capitalAmount = 0;

        $courtFlag = '';

        $colData = \App\GenericTableModels\coldata::select(['Defended', 'CourtFlag'])->where('MatterId', $matter['recordid'])->first();

        if ($colData) {
            $defendedFlag = $colData->Defended;
            $courtFlag = $colData->CourtFlag;
            if ($courtFlag == 'R') {
                $regionalFlag = true;
            }
        }

        //echo 'Fee Codes = ' . $request->feecodes . "\n";

        // Get the FeeItems
        $feeItemRequest = new \Illuminate\Http\Request;
        $feeItemRequest->wherein = 'FeeCodeID,'.$request->feecodes;
        $feeItemRequest->employeeid = $request->employeeid;
        $feeItemRequest->languageid = $request->languageid;

        if ($regionalFlag) {
            $feeItemRequest->whereraw = 'RegionalCourtFlag = 1 AND (FromDate < '.(string) $todaysDate.' OR FromDate IS NULL)';
        } else {
            $feeItemRequest->whereraw = '(RegionalCourtFlag = 0 OR RegionalCourtFlag IS NULL) AND (FromDate < '.(string) $todaysDate.' OR FromDate IS NULL)';
        }

        //echo 'WhereRaw = ' . $feeItemRequest->whereraw . "\n";

        $feeItemsResponse = $genericController->get($feeItemRequest, 'feeitem');

        $feeItems = $feeItemsResponse['data'];

        // Handle to Date
        $feeItems = array_filter($feeItems, function ($feeItem) use ($todaysDate) {

            //echo $feeItem['description'] . ' - ToDate = ' . $feeItem['todate'] . "\n";

            if (isset($feeItem['todate']) && (float) $feeItem['todate'] > 0) {
                return  $todaysDate < $feeItem['todate'];
            } else {
                return true;
            }
        });

        $bondData = \App\GenericTableModels\bonddata::select(['SalePrice', 'CapitalAmount'])->where('MatterId', $matter['recordid'])->first();

        if ($bondData) {
            $salePrice = (float) $bondData->SalePrice;
            $capitalAmount = (float) $bondData->CapitalAmount;
        }

        //echo '1 Count FeeItems = ' . count($feeItems) . "\n";

        // Handle To and From Amounts
        $feeItems = array_filter($feeItems, function ($feeItem) use ($claimAmount, $salePrice, $capitalAmount) {

            //echo $feeItem['description'] . ' - ToAmount = ' . $feeItem['toamount'] . "\n";

            if (isset($feeItem['toamount']) && (float) $feeItem['toamount'] > 0) {
                if ($feeItem['limitedby'] == 'C') {
                    if ($claimAmount < (float) $feeItem['fromamount']) {
                        return false;
                    } elseif ($claimAmount > (float) $feeItem['toamount']) {
                        return false;
                    } else {
                        return true;
                    }
                } elseif ($feeItem['limitedby'] == 'S') {
                    if ($salePrice < (float) $feeItem['fromamount']) {
                        return false;
                    } elseif ($salePrice > (float) $feeItem['toamount']) {
                        return false;
                    } else {
                        return true;
                    }
                } elseif ($feeItem['limitedby'] == 'B') {
                    if ($capitalAmount < (float) $feeItem['fromamount']) {
                        return false;
                    } elseif ($capitalAmount > (float) $feeItem['toamount']) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        });

        // Handle defended flag
        $feeItems = array_filter($feeItems, function ($feeItem) use ($defendedFlag) {
            if (isset($feeItem['defended'])) {
                if ($feeItem['defended'] == 'U') {
                    if ($defendedFlag == true) {
                        return false;
                    } else {
                        return true;
                    }
                } elseif ($feeItem['defended'] == 'D') {
                    if ($defendedFlag == false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return true;
                }
            } else {
                return true;
            }
        });

        // Handle *Drawing
        $feeItems = array_map(function ($feeItem) {
            if (stripos($feeItem['description'], '*Drawing') !== false || stripos($feeItem['description'], '* Drawing') !== false || stripos($feeItem['description'], '*Opstel') !== false || stripos($feeItem['description'], '* Opstel') !== false) {
                $feeItem['description'] = $feeItem['feecodedescription'];
            }

            return $feeItem;
        }, $feeItems);

        // Handle DiscountSurcharge
        $discountSurcharge = (float) $matter['discountsurcharge'];

        if ($discountSurcharge != 0) {
            $feeItems = array_map(function ($feeItem) use ($discountSurcharge) {
                if ($feeItem['feesheettype'] == 'F') {
                    $feeItem['amount'] += round((float) $feeItem['amount'] * ($discountSurcharge / 100), 2);

                    // DataTables needs this as a string
                    $feeItem['amount'] = (string) $feeItem['amount'];
                }

                return $feeItem;
            }, $feeItems);
        }

        // Handle Maximum Amount, FeeScaleAmount and add Date, EmployeeId & CostCentreId etc
        $feeItems = array_map(function ($feeItem) use ($matter, $todaysDate) {
            $feeItem['date'] = (string) $todaysDate;
            $feeItem['formatteddate'] = \App\Custom\Utils::stringFromClarionDate($todaysDate);
            $feeItem['matterid'] = $matter['recordid'];
            $feeItem['employeeid'] = $matter['employeeid'];
            $feeItem['employeename'] = $matter['employeename'];
            $feeItem['costcentreid'] = $matter['costcentreid'];
            $feeItem['unitquantity'] = '1';
            $feeItem['netamount'] = $feeItem['amount'];

            if (isset($feeItem['feescaleamount']) && (float) $feeItem['feescaleamount'] > 0) {
                $feeItem['amount'] = $feeItem['feescaleamount'];
            }

            if (isset($feeItem['maximumamount']) && (float) $feeItem['maximumamount'] > 0) {
                if ((float) $feeItem['amount'] > (float) $feeItem['maximumamount']) {
                    $feeItem['amount'] = $feeItem['maximumamount'];
                }
            }

            return $feeItem;
        }, $feeItems);

        foreach ($feeItems as $feeItem) {

            //echo 'All ' . $feeItem['description'] . ' - amount = ' . $feeItem['amount'] . "\n";

            $returnData->data[] = $feeItem;
        }

        return json_encode($returnData);
    }

    public function getBasicPartyData(Request $request)
    {
        $returnData = new \stdClass();

        $controller = new \App\Http\Controllers\GenericController;
        $currentPartyRequest = new \Illuminate\Http\Request;

        $currentPartyRequest->whereraw = 'Party.RecordID = '.$request->partyid;
        $currentParty = $controller->get($currentPartyRequest, 'party');
        $returnData->currentParty = $currentParty['data'][0];

        $returnData->extraScreens = \App\GenericTableModels\docscrn::select(['recordid', 'description', 'screentype'])->orderBy('description')->get();

        $returnData->branches = \App\GenericTableModels\branch::select(['Branch.recordid', 'Branch.description', 'Business.RecordID AS businessbankid', 'Business.Description AS businessbankdescription', 'Trust.RecordID AS trustbankid', 'Trust.Description AS trustbankdescription'])
        ->leftJoin('Business', 'Business.RecordID', '=', 'Branch.BusinessBankID')
        ->leftJoin('Business as Trust', 'Trust.RecordID', '=', 'Branch.TrustBankID')
        ->orderBy('Branch.Description')
        ->get();

        // $returnData->business = \App\GenericTableModels\business::select(['recordid','description', 'type'])->where('notusedflag','!=',1)->orderBy('description')->get();
        // $returnData->creditors = \App\GenericTableModels\creditor::select(['recordid','description'])->orderBy('description')->get();

        // $returnData->accounts = \App\GenericTableModels\business::select(['recordid','description','type'])->orderBy('description')
        // ->where('notusedflag','<>',1)
        // ->get();
        //$returnData->secProcs = \App\GenericTableModels\secproc::get();

        $returnData->documentSets = \App\GenericTableModels\docgen::select(['DocGen.recordid', 'DocGen.description', 'ToDoGroup.RecordID AS todogroupid', 'ToDoGroup.Description AS todogroupdescription'])
        ->leftJoin('ToDoGroup', 'ToDoGroup.RecordID', '=', 'DocGen.ToDoGroupID')
        ->where('NoOfUsers', '>', 0)
        ->whereNotIn('Type', ['ACC', 'DES'])
        ->orWhere('Type', 'GEN')
        ->orWhere('Type', 'CUS')
        ->orWhere('Code', 'NON')
        ->orderBy('Docgen.Description')
        ->get();

        $returnData->matterTypes = \App\GenericTableModels\mattype::select(['MatType.recordid', 'MatType.description', 'FeeSheet.RecordID AS feesheetid', 'FeeSheet.Description AS feesheetdescription'])
        ->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'MatType.FeeSheetID')
        ->orderBy('MatType.Description')
        ->get();

        $returnData->partyEntities = \App\GenericTableModels\entity::select(['recordid', 'description', 'category', 'juristicflag'])->orderBy('description')->get();
        $returnData->partyTypes = \App\GenericTableModels\partype::select(['recordid', 'description', 'category'])->orderBy('description')->get();
        $returnData->partyRoles = \App\GenericTableModels\role::select(['recordid', 'description', 'rolescrnflag', 'rolescrnid'])->orderBy('description')->get();
        $returnData->billingRates = \App\GenericTableModels\billingrate::select(['recordid', 'description', 'amount'])->orderBy('description')->get();
        $returnData->telephoneTypes = \App\GenericTableModels\teletype::select(['recordid', 'description', 'internalflag'])->orderBy('description')->get();

        $returnData->docLogCategories = \App\GenericTableModels\doclogcategory::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->docLogSubCategories = \App\GenericTableModels\doclogsubcategory::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->deedsOffices = \App\GenericTableModels\lawdeed_deedsoffice::select(['recordid', 'name'])->orderBy('name')->get();

        $returnData->costCentres = \App\GenericTableModels\costcentre::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->feeSheets = \App\GenericTableModels\feesheet::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->planOfActions = \App\GenericTableModels\todogroup::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->causeOfActions = \App\GenericTableModels\bondcause::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->stageGroups = \App\GenericTableModels\stagegroup::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->stages = \App\GenericTableModels\stage::select(['recordid', 'description', 'code', 'stagegroupid'])->orderBy('code')->get();
        $returnData->countries = \App\GenericTableModels\country::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->holidays = \App\GenericTableModels\holiday::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->languages = \App\GenericTableModels\language::select([
            'recordid',
            'description',
            'name',
            'physicalline1',
            'physicalline2',
            'physicalline3',
            'physicalline4',
            'physicalcode',
            'postalline1',
            'postalline2',
            'postalline3',
            'postalline4',
            'postalcode',
            'takeondescription',
            'currencysymbol',
            'feedescription',
            'disbursementdescription',
            'businesscreditordescription',
        ])->orderBy('description')->get();

        return json_encode($returnData);
    }

    public function getBasicData(Request $request)
    {
        $returnData = new \stdClass();

        $returnData->employees = \App\GenericTableModels\employee::select(['recordid', 'name', 'loginid', 'autodescriptionflag', 'autodescriptionseparator', 'defaultmatterdescription', 'defaultclientid', 'smtpusername', 'smtppassword'])->where('suspendedflag', '<>', 1)->orderBy('name')->get();

        if (! isset($request->employeeid)) {
            throw new \Exception('Logged In Employee\'s RecordId not specified');
        }

        $controller = new \App\Http\Controllers\GenericController;
        $currentEmployeeRequest = new \Illuminate\Http\Request;

        $currentEmployeeRequest->whereraw = 'Employee.RecordID = '.$request->employeeid;
        $currentEmployee = $controller->get($currentEmployeeRequest, 'employee');
        $returnData->currentEmployee = $currentEmployee['data'][0];

        $returnData->extraScreens = \App\GenericTableModels\docscrn::select(['recordid', 'description', 'screentype'])->orderBy('description')->get();

        $returnData->branches = \App\GenericTableModels\branch::select(['Branch.recordid', 'Branch.description', 'Business.RecordID AS businessbankid', 'Business.Description AS businessbankdescription', 'Trust.RecordID AS trustbankid', 'Trust.Description AS trustbankdescription'])
        ->leftJoin('Business', 'Business.RecordID', '=', 'Branch.BusinessBankID')
        ->leftJoin('Business as Trust', 'Trust.RecordID', '=', 'Branch.TrustBankID')
        ->orderBy('Branch.Description')
        ->get();

        $returnData->accounts = \App\GenericTableModels\business::select(['recordid', 'description', 'type'])->orderBy('description')
        ->where('notusedflag', '<>', 1)
        ->get();

        $returnData->documentSets = \App\GenericTableModels\docgen::select(['DocGen.recordid', 'DocGen.description', 'ToDoGroup.RecordID AS todogroupid', 'ToDoGroup.Description AS todogroupdescription'])
        ->leftJoin('ToDoGroup', 'ToDoGroup.RecordID', '=', 'DocGen.ToDoGroupID')
        ->where('NoOfUsers', '>', 0)
        ->whereNotIn('Type', ['ACC', 'DES'])
        ->orWhere('Type', 'GEN')
        ->orWhere('Type', 'CUS')
        ->orWhere('Code', 'NON')
        ->orderBy('Docgen.Description')
        ->get();

        $returnData->matterTypes = \App\GenericTableModels\mattype::select(['MatType.recordid', 'MatType.description', 'FeeSheet.RecordID AS feesheetid', 'FeeSheet.Description AS feesheetdescription'])
        ->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'MatType.FeeSheetID')
        ->orderBy('MatType.Description')
        ->get();

        $returnData->secProcs = \App\GenericTableModels\secproc::get();
        $returnData->partyEntities = \App\GenericTableModels\entity::select(['recordid', 'description', 'category', 'juristicflag'])->orderBy('description')->get();
        $returnData->partyTypes = \App\GenericTableModels\partype::select(['recordid', 'description', 'category'])->orderBy('description')->get();
        $returnData->partyRoles = \App\GenericTableModels\role::select(['recordid', 'description', 'rolescrnflag', 'rolescrnid'])->orderBy('description')->get();
        $returnData->billingRates = \App\GenericTableModels\billingrate::select(['recordid', 'description', 'amount'])->orderBy('description')->get();
        $returnData->telephoneTypes = \App\GenericTableModels\teletype::select(['recordid', 'description', 'internalflag'])->orderBy('description')->get();

        $returnData->docLogCategories = \App\GenericTableModels\doclogcategory::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->docLogSubCategories = \App\GenericTableModels\doclogsubcategory::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->deedsOffices = \App\GenericTableModels\lawdeed_deedsoffice::select(['recordid', 'name'])->orderBy('name')->get();

        $returnData->business = \App\GenericTableModels\business::select(['recordid', 'description', 'type'])->where('notusedflag', '!=', 1)->orderBy('description')->get();
        $returnData->creditors = \App\GenericTableModels\creditor::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->costCentres = \App\GenericTableModels\costcentre::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->feeSheets = \App\GenericTableModels\feesheet::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->planOfActions = \App\GenericTableModels\todogroup::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->causeOfActions = \App\GenericTableModels\bondcause::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->stageGroups = \App\GenericTableModels\stagegroup::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->stages = \App\GenericTableModels\stage::select(['recordid', 'description', 'code', 'stagegroupid'])->orderBy('code')->get();
        $returnData->countries = \App\GenericTableModels\country::select(['recordid', 'description'])->orderBy('description')->get();
        $returnData->holidays = \App\GenericTableModels\holiday::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->languages = \App\GenericTableModels\language::select([
            'recordid',
            'description',
            'name',
            'physicalline1',
            'physicalline2',
            'physicalline3',
            'physicalline4',
            'physicalcode',
            'postalline1',
            'postalline2',
            'postalline3',
            'postalline4',
            'postalcode',
            'takeondescription',
            'currencysymbol',
            'feedescription',
            'disbursementdescription',
            'businesscreditordescription',
        ])->orderBy('description')->get();

        return json_encode($returnData);
    }

    public function getBasicDataMobileApp(Request $request)
    {
        $returnData = new \stdClass();

        $returnData->employees = \App\GenericTableModels\employee::select(['recordid', 'name', 'loginid', 'autodescriptionflag', 'autodescriptionseparator', 'defaultmatterdescription', 'defaultclientid', 'smtpusername', 'smtppassword'])->where('suspendedflag', '<>', 1)->orderBy('name')->get();

        if (! isset($request->employeeid)) {
            throw new \Exception('Logged In Employee\'s RecordId not specified');
        }

        $controller = new \App\Http\Controllers\GenericController;

        $currentEmployeeRequest = new \Illuminate\Http\Request;

        $currentEmployeeRequest->whereraw = 'Employee.RecordID = '.$request->employeeid;

        $currentEmployee = $controller->get($currentEmployeeRequest, 'employee');

        $returnData->currentEmployee = $currentEmployee['data'][0];

        $returnData->branches = \App\GenericTableModels\branch::select(['Branch.recordid', 'Branch.description', 'Business.RecordID AS businessbankid', 'Business.Description AS businessbankdescription', 'Trust.RecordID AS trustbankid', 'Trust.Description AS trustbankdescription'])
        ->leftJoin('Business', 'Business.RecordID', '=', 'Branch.BusinessBankID')
        ->leftJoin('Business as Trust', 'Trust.RecordID', '=', 'Branch.TrustBankID')
        ->orderBy('Branch.Description')
        ->get();

        $returnData->accounts = \App\GenericTableModels\business::select(['recordid', 'description', 'type'])->orderBy('description')
        ->where('notusedflag', '<>', 1)
        ->get();

        $returnData->documentSets = \App\GenericTableModels\docgen::select(['DocGen.recordid', 'DocGen.description', 'ToDoGroup.RecordID AS todogroupid', 'ToDoGroup.Description AS todogroupdescription'])
        ->leftJoin('ToDoGroup', 'ToDoGroup.RecordID', '=', 'DocGen.ToDoGroupID')
        ->where('NoOfUsers', '>', 0)
        ->whereNotIn('Type', ['ACC', 'DES'])
        ->orWhere('Type', 'GEN')
        ->orWhere('Type', 'CUS')
        ->orWhere('Code', 'NON')
        ->orderBy('Docgen.Description')
        ->get();

        $returnData->matterTypes = \App\GenericTableModels\mattype::select(['MatType.recordid', 'MatType.description', 'FeeSheet.RecordID AS feesheetid', 'FeeSheet.Description AS feesheetdescription'])
        ->leftJoin('FeeSheet', 'FeeSheet.RecordID', '=', 'MatType.FeeSheetID')
        ->orderBy('MatType.Description')
        ->get();

        $returnData->secProcs = \App\GenericTableModels\secproc::get();

        $returnData->control = \App\GenericTableModels\control::get();

        $returnData->partyEntities = \App\GenericTableModels\entity::select(['recordid', 'description', 'category', 'juristicflag'])->orderBy('description')->get();

        $returnData->matActivities = \App\GenericTableModels\activity::select(['recordid', 'description', 'billableflag', 'unitsid', 'rate'])->orderBy('description')->get();

        $returnData->partyTypes = \App\GenericTableModels\partype::select(['recordid', 'description', 'category'])->orderBy('description')->get();

        $returnData->partyRoles = \App\GenericTableModels\role::select(['recordid', 'description', 'rolescrnflag', 'rolescrnid'])->orderBy('description')->get();

        $returnData->billingRates = \App\GenericTableModels\billingrate::select(['recordid', 'description', 'amount'])->orderBy('description')->get();

        $returnData->telephoneTypes = \App\GenericTableModels\teletype::select(['recordid', 'description', 'internalflag'])->orderBy('description')->get();

        $returnData->business = \App\GenericTableModels\business::select(['recordid', 'description', 'type', 'typeextension'])->where('notusedflag', '!=', 1)->orderBy('description')->get();

        $returnData->costCentres = \App\GenericTableModels\costcentre::select(['recordid', 'description'])->orderBy('description')->get();

        $returnData->feeSheets = \App\GenericTableModels\feesheet::select(['recordid', 'description', 'type', 'businessledgerflag', 'businessledgerid'])->orderBy('description')->get();

        $returnData->stageGroups = \App\GenericTableModels\stagegroup::select(['recordid', 'description'])->orderBy('description')->get();

        return json_encode($returnData);
    }

    public function logs(Request $request)
    {
        $disk = Storage::disk('logs');
        $files = $disk->files();

        $fileData = collect();
        foreach ($files as $file) {
            $fileData->push([
                'file' => $file,
                'date' => $disk->lastModified($file),
            ]);
        }
        $newest = $fileData->sortByDesc('date')->first();

        $contents = Storage::disk('logs')->get($newest['file']);

        $array = explode("\n", $contents);

        $i = 1;

        foreach ($array as $val) {
            $tempArray[] = explode('\\n', $val);
            if ($i < count($array)) {
                $tempArray[] = '-----------------------------------------------------------';
            }
            $i++;
        }

        return $tempArray;
    }

    public function clearlogs(Request $request)
    {
        $disk = Storage::disk('logs');
        $files = $disk->files();

        $fileData = collect();

        foreach ($files as $file) {
            $fileData->push([
                'file' => $file,
                'date' => $disk->lastModified($file),
            ]);
        }
        $newest = $fileData->sortByDesc('date')->first();

        Storage::disk('logs')->delete($newest['file']);
        Log::info('New Log File');

        return 'Logs Cleared';
    }

    public function getPhpInfo()
    {
        return phpinfo();
    }
}
