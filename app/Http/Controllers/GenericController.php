<?php

namespace App\Http\Controllers;

use App\Custom\BusinessRulesController;
use App\Custom\ControllerHelper;
use App\Custom\ParameterBuilder;
use App\Custom\SelectAndJoinBuilder;
use App\Developer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class GenericController extends Controller
{
    public function get(Request $request, $tableName, $recordid = null)
    {
        $query = DB::connection('sqlsrv')->table($tableName);

        ParameterBuilder::ParameterBuilder($query, $request);

        $this->setSelectAndJoins($request, strtolower($tableName), $query);

        if (isset($request->recordid)) {
            $query->where($tableName.'.recordid', $request->recordid);
        } elseif (isset($recordid)) {
            $query->where($tableName.'.recordid', $recordid);
        }

        if (isset($request->method)) {
            return ControllerHelper::MethodHelperNew($query, $request);
        } else {
            return ControllerHelper::DataFormatHelper($query, $request);
        }
    }

    public function store(Request $request, $tableName)
    {

/* Test in Tinker
$controller = new \App\Http\Controllers\GenericController;
$request = new \Illuminate\Http\Request;
$request['description'] = "XXX";
$request['shortdesc'] = "XXX";
$request['tooltipcategory'] = "Custom string to filter the Matter Parties";
$controller->store($request, 'library');
*/

        $className = 'App\\GenericTableModels\\'.strtolower($tableName);
        $model = new $className;
        $primaryKey = $model->getKeyName();

        if (! $model->incrementing && ! is_array($primaryKey)) {
            $id = $model::max($primaryKey);

            $request[strtolower($primaryKey)] = $id + 1;
        }

        $requestData = $request->all();

        if (method_exists('App\Custom\BusinessRulesController', 'Store'.strtolower($tableName))) {
            $businessRulesController = new BusinessRulesController;
            $methodName = 'Store'.strtolower($tableName);
            $recordData = $businessRulesController->$methodName($requestData);

        //logger('$recordData for '. $methodName,[$recordData]);
        } else {
            $recordData = $model::create($requestData);
        }

        //if ( App::environment('local') ) logger('Created Matter $recordData',(array) $recordData);

        if (isset($request->loggedinemployeeid) && isset($recordData->recordid)) {
            $source = Developer::where('id', $request->user()->developerId)->first()->company_name;

            $controllerHelper = new ControllerHelper;

            $controllerHelper->addEmployeeLogFile((object) $recordData, strtolower($tableName), 'Store', $source, $request->loggedinemployeeid);
        }

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    public function update(Request $request, $tableName)
    {
        $className = 'App\\GenericTableModels\\'.strtolower($tableName);
        $model = new $className;

        $requestData = $request->all();

        if (method_exists('App\Custom\BusinessRulesController', 'Update'.strtolower($tableName))) {
            $businessRulesController = new BusinessRulesController;
            $methodName = 'Update'.strtolower($tableName);
            $recordData = $businessRulesController->$methodName($requestData);
        } else {
            $primaryKey = $model->getKeyName();

            foreach ((array) $primaryKey as $keyName) {
                $keyName = strtolower($keyName);

                if (isset($request->$keyName)) {
                    $query = $model::where($tableName.'.'.$keyName, $request->$keyName);
                    unset($requestData[$keyName]);
                } else {
                    $returnData['errors'] = "$tableName.$keyName was not specified.";

                    return $returnData;
                }
            }

            $recordData = $query->first();

            if (! $recordData) {
                $returnData['errors'] = ucfirst($tableName).' not found';

                return $returnData;
            } else {
                $recordData->update($requestData);
            }
        }

        if (isset($request->loggedinemployeeid)) {
            $controllerHelper = new ControllerHelper;
            $source = Developer::where('id', $request->user()->developerId)->first()->company_name;
            $controllerHelper->addEmployeeLogFile((object) $request, strtolower($tableName), 'Update', $source, $request->loggedinemployeeid);
        }

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    public function delete(Request $request, $tableName, $recordid = null)
    {

        /* Testing in Tinker
        $controller = new App\Http\Controllers\GenericController
        $recordid = 1261717;$request = new Illuminate\Http\Request;$request->recordid = $recordid;
        $controller->delete($request, 'filenote')
        */

        $className = 'App\\GenericTableModels\\'.strtolower($tableName);
        $model = new $className;

        $requestData = $request->all();

        if (method_exists('App\Custom\BusinessRulesController', 'Delete'.strtolower($tableName))) {
            $businessRulesController = new BusinessRulesController;
            $methodName = 'Delete'.strtolower($tableName);
            $recordData = $businessRulesController->$methodName($requestData);
        } else {
            if (isset($recordid)) {
                $query = $model::where($tableName.'.recordid', $recordid);
            } else {
                $primaryKey = $model->getKeyName();

                foreach ((array) $primaryKey as $keyName) {
                    $keyName = strtolower($keyName);

                    if (isset($request->$keyName)) {
                        $query = $model::where($tableName.'.'.$keyName, $request->$keyName);
                    } else {
                        $returnData['errors'] = "$tableName.$keyName was not specified.";

                        return $returnData;
                    }
                }
            }

            $recordData = $query->first();

            if (! $recordData) {
                $returnData['errors'] = ucfirst($tableName).' not found';

                return $returnData;
            } else {
                $recordData = $recordData->delete();
            }
        }

        if (isset($request->loggedinemployeeid)) {
            $controllerHelper = new ControllerHelper;
            $source = Developer::where('id', $request->user()->developerId)->first()->company_name;
            $controllerHelper->addEmployeeLogFile((object) $recordData, strtolower($tableName), 'Delete', $source, $request->loggedinemployeeid);
        }

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    public function delete_short_version_deprecate(Request $request, $tableName, $recordId)
    {
        $className = 'App\\GenericTableModels\\'.strtolower($tableName);
        $model = new $className;

        $recordData = $model::find($recordId);

        $recordData->delete();

        if (isset($request->loggedinemployeeid)) {
            $controllerHelper = new ControllerHelper;
            $source = Developer::where('id', $request->user()->developerId)->first()->company_name;
            $controllerHelper->addEmployeeLogFile((object) $recordData, strtolower($tableName), 'Delete', $source, $request->loggedinemployeeid);
        }

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    public function storeRecords(Request $request, $tableName)
    {

        // *****************************************************************************
        // Store an array of records all at once
        // Used to save generated documents to Document Log
        // *****************************************************************************

        $result = DB::connection('sqlsrv')->table($tableName)->insert($request['records']);

        $returnData['data'] = [];

        if (! $result) {
            $returnData['errors'] = 'An error was encountered saving the Records';
        }

        return json_encode($returnData);

        /* For Testing in Tinker
        $records = array(
            'matterId' => 71017,
            'partyId' => 0,
            'documentId' => 0,
            'description' => 'Test Document',
            'employeeId' => '5',
            'date' => 8000,
            'time' => 8381000,
            'docLogCategoryId' => 1,
            'savedName' => 'Cloud',
            'direction' => 1
        );

        DB::connection('sqlsrv')->table('doclog')->insert($records);*/
    }

    /* Testing in Tinker
    $controller = new App\Http\Controllers\GenericController
    $recordid = 71017;
    $request = new Illuminate\Http\Request;
    $request->source = "Matter";
    $controller->getTemplateData($request, 'matter', $recordid)

    $tableName = 'matparty'; $recordid = 119280;
    $request = new Illuminate\Http\Request;
    $request->source = "MatParty";
    $query = DB::connection('sqlsrv')->table($tableName);
    \App\Custom\ParameterBuilder::ParameterBuilder($query, $request);
    $this->setSelectAndJoins($request, strtolower($tableName), $query);
    $query->where( $tableName . '.recordid', $recordid);
    $result = $query->get();

    $returnData[$tableName] = $result[0];
    print_r($returnData[$tableName]);

    $tableName = 'matter'; $recordid = 71017;
    $request = new Illuminate\Http\Request;
    $request->source = "MatParty";
    $query = DB::connection('sqlsrv')->table($tableName);
    \App\Custom\ParameterBuilder::ParameterBuilder($query, $request);
    $this->setSelectAndJoins($request, strtolower($tableName), $query);
    $query->where( $tableName . '.recordid', $recordid);
    $result = $query->get();
    $returnData[$tableName] = $result[0];
    print_r($returnData[$tableName]);

    $controller = new App\Http\Controllers\GenericController
    $recordid = 119280;
    $request = new Illuminate\Http\Request;
    $request->source = "MatParty";
    $controller->getTemplateData($request, 'matparty', $recordid)

    */

    public function getTemplateData(Request $request, $tableName, $recordid)
    {

        // *****************************************************************************
        // 13 Feb 2022 - Template Fields are returned in the lower case!!
        // *****************************************************************************

        $query = DB::connection('sqlsrv')->table($tableName);

        ParameterBuilder::ParameterBuilder($query, $request);

        if (strtolower($tableName) == 'party') {
            $query->addselect('parlang.*');
        }

        if (strtolower($tableName) == 'matter') {
            $query->addselect('conveydata.*')->addselect('bonddata.*')->addselect('coldata.*');
        }

        $this->setSelectAndJoins($request, strtolower($tableName), $query);

        $query->where($tableName.'.recordid', $recordid);

        $result = $query->get();

        if (count($result)) {
            $returnData[$tableName] = $result[0];
        } else {
            throw new \Exception('Unable to retrieve the '.$request->source.' record while trying to create Template Data');
        }

        if ($request->source === 'MatParty') {

            // **********************************************
            // Get the Party
            // **********************************************
            $partyRequest = new \Illuminate\Http\Request;
            $partyQuery = DB::connection('sqlsrv')->table('Party');
            $partyQuery->where('Party.RecordID', $returnData[$tableName]->partyid);

            $this->setSelectAndJoins($partyRequest, 'party', $partyQuery);

            $partyResult = $partyQuery->get();

            if (count($partyResult)) {
                $returnData['party'] = $partyResult[0];
            } else {
                $returnData['party'] = (object) null;
            }

            // **********************************************
            // Get the Matter
            // **********************************************
            $matterRequest = new \Illuminate\Http\Request;
            $matterQuery = DB::connection('sqlsrv')->table('Matter');
            $matterQuery->where('Matter.RecordID', $returnData[$tableName]->matterid);

            $this->setSelectAndJoins($matterRequest, 'matter', $matterQuery);

            $matterResult = $matterQuery->get();

            if (count($matterResult)) {
                $returnData['matter'] = $matterResult[0];
            } else {
                $returnData['matter'] = (object) null;
            }
        } elseif ($request->source === 'Matter') {

            // **********************************************
            // Matter's Client
            // **********************************************
            $clientRequest = new \Illuminate\Http\Request;
            $clientQuery = DB::connection('sqlsrv')->table('Party');
            $clientQuery->where('Party.RecordID', $returnData[$tableName]->clientid);

            $this->setSelectAndJoins($clientRequest, 'party', $clientQuery);

            $clientResult = $clientQuery->get();

            if (count($clientResult)) {
                $returnData['client'] = $clientResult[0];
            } else {
                $returnData['client'] = (object) null;
            }

            // **********************************************
            // ColDebits
            // **********************************************

            if ($returnData[$tableName]->docgentype == 'LIT' && $returnData[$tableName]->docgencode != 'AMO') {
                $colDebitQuery = DB::connection('sqlsrv')->table('ColDebit');
                $colDebitQuery->where('MatterID', $returnData[$tableName]->recordid);
                $colDebitQuery->orderBy('Date')->orderBy('TimerStamp');

                $returnData['colDebits'] = $colDebitQuery->get();
            } else {
                $returnData['colDebits'] = [];
            }

            if (isset($request->roleid) && isset($request->sorter)) {

                // **********************************************
                // MatParty
                // **********************************************

                $matPartyRequest = new \Illuminate\Http\Request;
                $matPartyQuery = DB::connection('sqlsrv')->table('MatParty');
                $matPartyQuery->where('MatParty.RoleId', $request->roleid);
                $matPartyQuery->where('MatParty.MatterId', $returnData[$tableName]->recordid);
                $matPartyQuery->where('MatParty.Sorter', $request->sorter);

                $this->setSelectAndJoins($matPartyRequest, 'matparty', $matPartyQuery);

                $matPartyResult = $matPartyQuery->get();

                if (count($matPartyResult)) {
                    $returnData['matParty'] = $matPartyResult[0];

                    // **********************************************
                    // Party
                    // **********************************************

                    $partyRequest = new \Illuminate\Http\Request;
                    $partyQuery = DB::connection('sqlsrv')->table('Party');
                    $partyQuery->where('Party.RecordID', $matPartyResult[0]->partyid);

                    $this->setSelectAndJoins($partyRequest, 'party', $partyQuery);

                    $partyResult = $partyQuery->get();

                    if (count($partyResult)) {
                        $returnData['party'] = $partyResult[0];
                    } else {
                        $returnData['party'] = (object) null;
                    }
                } else {
                    $returnData['matParty'] = (object) null;
                    $returnData['party'] = (object) null;
                }
            }
        } elseif ($request->source === 'Party') {
        }

        return json_encode($returnData);
    }

    /*
        public function getTemplateData_Old(Request $request, $tableName, $recordid) {

            // *****************************************************************************
            // Note - Template Fields are returned in the same case as the SQL Table Columns
            // So the user can select Fields that are easier to read.
            // *****************************************************************************

            $query = DB::connection('sqlsrv')->table($tableName);

            ParameterBuilder::ParameterBuilder($query, $request);

            if ( strtolower($tableName) == 'party' ) $query->addselect('parlang.*');

            if ( strtolower($tableName) == 'matter' ) $query->addselect('conveydata.*')->addselect('bonddata.*')->addselect('coldata.*');

            $this->setSelectAndJoins($request, strtolower($tableName), $query);

            $query->where( $tableName . '.recordid', $recordid);

            $result = $query->get();

            $returnData[$tableName] = $result[0];

            if ( $request->source === 'Matter' ) {

                // **********************************************
                // Matter's Client
                // **********************************************
                $clientRequest = new \Illuminate\Http\Request;
                $clientQuery = DB::connection('sqlsrv')->table('Party');
                $clientQuery->where('Party.RecordID', $returnData[$tableName]->ClientID);

                $this->setSelectAndJoins($clientRequest, 'party', $clientQuery);

                $clientResult = $clientQuery->get();

                if ( count($clientResult) ) {
                    $returnData['client'] = $clientResult[0];
                } else {
                    $returnData['client'] = (object) null;
                }

                // **********************************************
                // ColDebits
                // **********************************************

                if ( $returnData[$tableName]->DocGenType == 'LIT' && $returnData[$tableName]->DocGenCode != 'AMO' ) {

                    $colDebitQuery = DB::connection('sqlsrv')->table('ColDebit');
                    $colDebitQuery->where('MatterID', $returnData[$tableName]->RecordID);
                    $colDebitQuery->orderBy('Date')->orderBy('TimerStamp');

                    $returnData['colDebits'] = $colDebitQuery->get();

                } else {

                    $returnData['colDebits'] = [];

                }

                if ( isset($request->roleid) && isset($request->sorter) ) {

                    // **********************************************
                    // MatParty
                    // **********************************************

                    $matPartyRequest = new \Illuminate\Http\Request;
                    $matPartyQuery = DB::connection('sqlsrv')->table('MatParty');
                    $matPartyQuery->where('MatParty.RoleId', $request->roleid);
                    $matPartyQuery->where('MatParty.MatterId', $returnData[$tableName]->RecordID);
                    $matPartyQuery->where('MatParty.Sorter', $request->sorter);

                    $this->setSelectAndJoins($matPartyRequest, 'matparty', $matPartyQuery);

                    $matPartyResult = $matPartyQuery->get();

                    if ( count($matPartyResult) ) {

                        $returnData['matParty'] = $matPartyResult[0];

                        // **********************************************
                        // Party
                        // **********************************************

                        $partyRequest = new \Illuminate\Http\Request;
                        $partyQuery = DB::connection('sqlsrv')->table('Party');
                        $partyQuery->where('Party.RecordID', $matPartyResult[0]->PartyID);

                        $this->setSelectAndJoins($partyRequest, 'party', $partyQuery);

                        $partyResult = $partyQuery->get();

                        if ( count($partyResult) ) {
                            $returnData['party'] = $partyResult[0];
                        } else {
                            $returnData['party'] = (object) null;
                        }


                    } else {
                        $returnData['matParty'] = (object) null;
                        $returnData['party'] = (object) null;
                    }

                }

            } else if ( $request->source === 'Party' ) {

            }

            return json_encode($returnData);

        }
    */
    public function copy(Request $request, $tableName)
    {
        $className = 'App\\GenericTableModels\\'.strtolower($tableName);
        $model = new $className;
        $primaryKey = $model->getKeyName();

        //The Model must have a single Primary Key for this to work

        $id = $model::max($primaryKey) + 1;

        $newRecord = $request->all();

        if ($model->incrementing) {
            unset($newRecord[strtolower($primaryKey)]);
        } else {
            $newRecord[strtolower($primaryKey)] = $id;
        }

        //$uniqueColumns (array) must be defined in the Model for this to work

        if (isset($model->uniqueColumns)) {
            foreach ($model->uniqueColumns as $column) {
                $newRecord[$column] .= ' ('.$id.')';
            }
        }

        $recordData = $model::create($newRecord);

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    // Need this in LOL to create dummy Template data
    public function first(Request $request, $tableName)
    {
        $query = DB::connection('sqlsrv')->table($tableName);

        $query->select('recordid as recordid');

        $result = $query->first();

        if (! $result) {
            throw new \Exception('Unable to retrieve first record in '.$tableName.' table');
        }

        $returnData['recordid'] = $result->recordid;

        return json_encode($returnData);
    }

    private function setSelectAndJoins(Request $request, $tableName, &$query)
    {
        if (method_exists('App\Custom\SelectAndJoinBuilder', strtolower($tableName).'JoinBuilder') && ! $request->removejoinbuilder) {
            SelectAndJoinBuilder::{strtolower($tableName).'JoinBuilder'}($query, $request);
        }

        // Used to set the tagging as the user pages through a table
        if (isset($request->taggingemployeeid) && isset($request->taggingtablename)) {
            $query->leftJoin('LolTagged', function ($join) use ($request, $tableName) {
                $join->on('LolTagged.taggedId', '=', $tableName.'.RecordID')
                ->where('LolTagged.tableName', '=', $request->taggingtablename)
                ->where('LolTagged.employeeId', '=', $request->taggingemployeeid);
            });
        }

        if (method_exists('App\Custom\SelectAndJoinBuilder', strtolower($tableName).'SelectBuilder') && ! $request->select && ! $request->selectraw && ! $request->columnraw && ! $request->column) {
            SelectAndJoinBuilder::{strtolower($tableName).'SelectBuilder'}($query, $request);
        } elseif (! $request->select && ! $request->selectraw && ! $request->columnraw && ! $request->column) {
            $query->addselect($tableName.'.*');

            // Used to set the tagging as the user pages through a table
            if (isset($request->taggingemployeeid) && isset($request->taggingtablename)) {
                $query->addselect(DB::raw('CASE WHEN ISNULL(LolTagged.taggedId,0) = 0 THEN 0 ELSE 1 END AS tagged'));
            }
        }
    }

    public function view(Request $request, $tableName)
    {
        if ($tableName) {
            $query = DB::connection('sqlsrv')->table($tableName);

            ParameterBuilder::ParameterBuilder($query, $request);

            if (isset($request->method)) {
                return ControllerHelper::MethodHelperNew($query, $request);
            }

            return ControllerHelper::DataFormatHelper($query, $request);
        } else {
            return json_encode(['errors' => 'Please enter Table Name']);
        }
    }
}
