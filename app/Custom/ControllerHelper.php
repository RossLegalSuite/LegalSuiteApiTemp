<?php

namespace App\Custom;

use App\Custom\ModelHelper;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;

class ControllerHelper
{
    public static function tryCatch($data, $func)
    {
        return $func($data);
        // try
        // {
        //     return $func($data);

        // } catch (\PDOException $e) {

        //     $returnData = new \stdClass();
        //     $returnData->data = [];
        //     $returnData->errors = $e->getMessage();
        //     return json_encode($returnData);

        // } catch (\Illuminate\Database\QueryException $e) {

        //     $returnData = new \stdClass();
        //     $returnData->data = [];
        //     $returnData->errors = $e->getMessage();
        //     return json_encode($returnData);

        // } catch(\Exception $e)  {

        //     $returnData = new \stdClass();
        //     $returnData->data = [];
        //     $returnData->errors = 'Server Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage();
        //     return json_encode($returnData);

        // } catch(\Throwable $e)  {

        //     $returnData = new \stdClass();
        //     $returnData->data = [];
        //     $returnData->errors = 'Throwable Error on line '.$e->getLine().' in '.$e->getFile() .': <br/>'.$e->getMessage();
        //     return json_encode($returnData);

        // }
    }

    public static function PostAndPutFormatHelper($responseObject)
    {
        if ($responseObject['errors']) {
            $returnData = json_encode($responseObject);
        } else {
            $responseArray = @json_decode(json_encode($responseObject), true);
            $returnData['data'][0] = array_change_key_case($responseArray, CASE_LOWER);
        }

        return $returnData;
    }

    public static function PostPutDeleteFormatHelper($responseObject, $request, $tableName = null, $process = null)
    {
        if (isset($responseObject['errors'])) {
            $returnData = json_encode($responseObject);
        } else {
            if (is_object($responseObject)) {

                // You can quickly convert deeply nested objects to associative arrays by relying on the behavior of the JSON encode/decode functions:
                // $array = json_decode(json_encode($nested_object), true);
                // $array = https://stackoverflow.com/questions/4345554/convert-a-php-object-to-an-associative-array

                $responseArray = @json_decode(json_encode($responseObject), true);

                // This is to return all data as a string ( Primary key does not on create)
                //https://laracasts.com/discuss/channels/general-discussion/modelcreate-returns-id-as-integer-while-modelfind-return-it-as-string
                $responseArray = array_map('strval', $responseArray);

                $returnData['data'][0] = array_change_key_case($responseArray);
            } elseif ($responseObject) {

                //????????????????????????????????????????????????????????
                //if boolean is true meaning delete has correctly happened.
                //????????????????????????????????????????????????????????

                $returnData['data'] = [];
            } else {
                $returnData['errors'] = 'System Error in PostPutDeleteFormatHelper - $responseObject does not exist';
            }
        }

        return $returnData;
    }

    public function addEmployeeLogFile($requestData, $tableName, $process, $source, $loggedinemployeeid)
    {
        try {
            $data = new \stdClass();
            $data->date = ModelHelper::convertClarionDate(date('Y-m-d'));
            $data->time = ModelHelper::convertClarionTime(date('H:i:s'));
            $data->tablename = $tableName;

            $data->source = $source;

            if (! isset($data->source)) {
                throw new \Exception('Server Error in addEmployeeLogFile in ControllerHelper: No source specified');
            }

            $data->processname = $process.ucfirst($tableName);

            if ($process == 'Store') {
                $data->action = 1;
            } elseif ($process == 'Update') {
                $data->action = 2;
            } elseif ($process == 'Delete') {
                $data->action = 3;
            } elseif ($process == 'Error') {
                $data->action = 4;
            } else {
                throw new \Exception('Server Error in addEmployeeLogFile in ControllerHelper: Invalid $process ('.$process.')');
            }

            // ************************************
            // Add the Record ID
            // ************************************
            if (! isset($requestData->recordid)) {
                throw new \Exception('Server Error in addEmployeeLogFile in ControllerHelper: No RecordID specified');
            }
            $data->itemrecordid = $requestData->recordid;

            $data->employeeid = $loggedinemployeeid;

            $data->description = isset($requestData->description) ? $requestData->description : '';

            if (strtolower($tableName) == 'matter') {
                $data->fileref = $requestData->fileref;
            } elseif (strtolower($tableName) == 'party') {
                $data->fileref = $requestData->matterprefix;
                $data->description = $requestData->name;
            } else {
                $data->fileref = '';
            }

            \App\GenericTableModels\employeelogfile::create((array) $data);

            if (App::environment('local')) {
                logger('Created EmployeeLogFile Record', (array) $data);
            }
        } catch (\Exception $e) {
            throw new \Exception('Server Error on line '.$e->getLine().' in '.$e->getFile().': <br/>'.$e->getMessage());
        }
    }

    public static function DetailFormatHelper($query, $request)
    {
        $responseObject = $query->get();

        if ($responseObject->isEmpty()) {
            $responseObject['data'] = [];

            return $responseObject;
        }

        $responseArray = @json_decode(json_encode($responseObject), true);
        $returnData['data'][0] = array_change_key_case($responseArray[0], CASE_LOWER);

        return $returnData;
    }

    public static function StoredProcedureFormatHelper($responseObject, $request)
    {
        if (gettype($responseObject) == 'array') {
            $queryResult = [];

            foreach ($responseObject as $key => $value) {
                $queryResult[$key] = array_change_key_case((array) $responseObject[$key], CASE_LOWER);
            }

            $returnData['data'] = $queryResult;

            return $returnData;
        } else {
            $returnData['data'] = $responseObject;

            return $returnData;
        }
    }

    public static function DataFormatHelper($query, $request)
    {

        // Must come from a DataTables request
        if ($request->has(['start', 'length', 'order'])) {
            $dataTablesData = datatables()->of($query)->toArray();

            foreach ($dataTablesData['data'] as $key => $value) {
                $dataTablesData['data'][$key] = array_change_key_case($dataTablesData['data'][$key], CASE_LOWER);
            }

            return json_encode($dataTablesData);
        } elseif ($request->has(['start', 'length'])) {
            $data = datatables()->of($query)

            ->order(function ($query) use ($request) {
                foreach ((array) $request->orderby as $parameter) {
                    $orderByArray = explode(',', $parameter);
                    if (isset(array_values($orderByArray)[1])) {
                        $query->orderBy(trim(array_values($orderByArray)[0]), trim(array_values($orderByArray)[1]));
                    } else {
                        $query->orderBy(trim(array_values($orderByArray)[0]), 'ASC');
                    }
                }
            })->toJson();

            //This may cause a break as it removed the draw key in the result set.
            $returnData['recordsTotal'] = $data->original['recordsTotal'];

            foreach ((array) $data->original['data'] as $key => $value) {
                $returnData['data'][$key] = array_change_key_case($data->original['data'][$key], CASE_LOWER);
            }

            return $returnData;
        } else {
            $data = $query->get();

            $queryResult = [];

            foreach ($data as $key => $value) {
                $queryResult[$key] = array_change_key_case((array) $data[$key], CASE_LOWER);
            }

            $returnData['data'] = $queryResult;

            return $returnData;
        }
    }

    public static function MethodHelperNew(&$query, $request)
    {
        if ($request->method === 'getSql' || $request->method === 'toSql') {
            return str_replace_array('?', $query->getBindings(), $query->toSql());
        } elseif ($request->method === 'testSql') {
            $returnData = (object) [];
            $returnData->count = 0;
            $returnData->error = '';

            try {
                $returnData->query = str_replace_array('?', $query->getBindings(), $query->toSql());
                $returnData->count = $query->count();
            } catch (QueryException $ex) {
                $returnData->error = $ex->getMessage();
            }

            return \json_encode($returnData);
        } elseif ($request->method === 'count') {
            $returnData['data'] = $query->count();

            return $returnData;
        } elseif ($request->method === 'top20') {
            $queryResult = $query->limit(20)->get();

            $returnData['data'] = $queryResult;

            return $returnData;
        } elseif ($request->method === 'getAll') {
            return $query->get()->toJson();
        }
    }

    public static function MethodHelper(&$query, $request)
    {
        if ($request->method === 'getSql') {
            return str_replace_array('?', $query->getBindings(), $query->toSql());
        } elseif ($request->method === 'testSql') {
            $returnData = (object) [];
            $returnData->count = 0;
            $returnData->error = '';

            try {
                $returnData->query = str_replace_array('?', $query->getBindings(), $query->toSql());
                $returnData->count = $query->count();
            } catch (QueryException $ex) {
                $returnData->error = $ex->getMessage();
            }

            return \json_encode($returnData);
        } elseif ($request->method === 'count') {
            $returnData['data'] = $query->count();

            return $returnData;

        // $queryResult = $query->count();
            // $returnData["count"] =  $queryResult;

            // return $returnData;
        } elseif ($request->method === 'top20') {
            $queryResult = $query->limit(20)->get();

            $returnData['data'] = $queryResult;

            return $returnData;
        } elseif ($request->method === 'getAll') {
            return $query->get()->toJson();
        }
    }

    public static function CalculateDate($period)
    {
        $calculateStartDate = null;
        $calculateEndDate = null;

        if ($period === 'Today') {
            $calculateStartDate = date('Y-m-d');
            $calculateEndDate = date('Y-m-d');
        } elseif ($period === 'Yesterday') {
            $calculateStartDate = date('Y-m-d', strtotime('Yesterday'));
            $calculateEndDate = date('Y-m-d', strtotime('Yesterday'));
        } elseif ($period === 'This Week') {
            $monday = strtotime('monday this week');
            $sunday = strtotime('sunday this week');

            $calculateStartDate = date('Y-m-d', $monday);
            $calculateEndDate = date('Y-m-d', $sunday);
        } elseif ($period === 'This Week') {
            $monday = strtotime('monday last week');
            $sunday = strtotime('sunday last week');

            $calculateStartDate = date('Y-m-d', $monday);
            $calculateEndDate = date('Y-m-d', $sunday);
        } elseif ($period === 'This Month') {
            $calculateStartDate = date('Y-m-01', strtotime('This Month'));
            $calculateEndDate = date('Y-m-t', strtotime('This Month'));
        } elseif ($period === 'Last Month') {
            $calculateStartDate = date('Y-m-01', strtotime('Last Month'));
            $calculateEndDate = date('Y-m-t', strtotime('Last Month'));
        } elseif ($period === 'This Year') {
            $calculateStartDate = date('Y-01-01', strtotime('This Year'));
            $calculateEndDate = date('Y-12-31', strtotime('This Year'));
        } elseif ($period === 'Last Year') {
            $calculateStartDate = date('Y-01-01', strtotime('Last Year'));
            $calculateEndDate = date('Y-12-31', strtotime('Last Year'));
        }

        $dateObject = (object) ['startDate' => $calculateStartDate, 'endDate' => $calculateEndDate];

        return $dateObject;
    }

    // public static function ColumnFilter(&$query, $request)
    // {

        //     $searchBy = $request->input('searchBy');
        //     $searchFor = $request->input('searchFor');

        //     if (!$searchFor || !$searchBy) {
            //         return;
            //     }

            //     $helperClass = new \Yajra\DataTables\Utilities\Request;

            //     if ($searchBy === 'All' || $searchBy === 'Mobile') {

                //         // Must you use a sub query function here so it puts brackets around this where clause
                //         $query->where(function ($query) use ($helperClass, $searchFor) {

                    //             $searchableColumns = $helperClass->searchableColumnIndex();
                    //             $counter = 0;
                    //             foreach ($searchableColumns as $column) {

                        //                 if (!$counter) {
                            //                     $query->where($helperClass->columnName($column), 'like', "%" . $searchFor . "%");
                            //                 } else {
                                //                     $query->orWhere($helperClass->columnName($column), 'like', "%" . $searchFor . "%");
                                //                 }
                                //                 $counter++;
                                //             }
                                //         });
                                //     } else {

                                    //         $query->where($helperClass->columnName((int) $searchBy), 'like', "%" . $searchFor . "%");
                                    //     }
                                    // }

                                    // public static function LogSqlQuery($query, $method = '')
                                    // {

                                        //     if (config('app.debug')) {

                                            //         $sqlQuery = str_replace_array('?', $query->getBindings(), $query->toSql());
                                            //         logger($method . ':', [$sqlQuery]);
                                            //     }
                                            // }

                                            // public static function CalculateDate($period)
                                            // {
                                                //     $calculateStartDate = null;
                                                //     $calculateEndDate = null;

                                                //     if ($period === 'Today') {

                                                    //         $calculateStartDate = date("Y-m-d");
                                                    //         $calculateEndDate = date("Y-m-d");
                                                    //     } else if ($period === 'Yesterday') {

                                                        //         $calculateStartDate = date("Y-m-d", strtotime("Yesterday"));
                                                        //         $calculateEndDate = date("Y-m-d", strtotime("Yesterday"));
                                                        //     } else if ($period === 'This Week') {

                                                            //         $monday = strtotime('monday this week');
                                                            //         $sunday = strtotime('sunday this week');

                                                            //         $calculateStartDate = date('Y-m-d', $monday);
                                                            //         $calculateEndDate = date('Y-m-d', $sunday);
                                                            //     } else if ($period === 'This Week') {

                                                                //         $monday = strtotime('monday last week');
                                                                //         $sunday = strtotime('sunday last week');

                                                                //         $calculateStartDate = date('Y-m-d', $monday);
                                                                //         $calculateEndDate = date('Y-m-d', $sunday);
                                                                //     } else if ($period === 'This Month') {

                                                                    //         $calculateStartDate = date("Y-m-01", strtotime("This Month"));
                                                                    //         $calculateEndDate = date("Y-m-t", strtotime("This Month"));
                                                                    //     } else if ($period === 'Last Month') {

                                                                        //         $calculateStartDate = date("Y-m-01", strtotime("Last Month"));
                                                                        //         $calculateEndDate = date("Y-m-t", strtotime("Last Month"));
                                                                        //     } else if ($period === 'This Year') {

                                                                            //         $calculateStartDate = date("Y-01-01", strtotime("This Year"));
                                                                            //         $calculateEndDate = date("Y-12-31", strtotime("This Year"));
                                                                            //     } else if ($period === 'Last Year') {

                                                                                //         $calculateStartDate = date("Y-01-01", strtotime("Last Year"));
                                                                                //         $calculateEndDate = date("Y-12-31", strtotime("Last Year"));
                                                                                //     }

                                                                                //     $dateObject = (object) ['startDate' => $calculateStartDate, 'endDate' => $calculateEndDate];

                                                                                //     return $dateObject;
                                                                                // }
}
