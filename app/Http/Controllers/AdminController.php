<?php

namespace App\Http\Controllers;

use App\Company;
use App\Custom\ControllerHelper;
use App\Custom\ParameterBuilder;
use App\Developer;
use App\ErrorLog;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getTrafficLog(Request $request)
    {
        if (! $request->header('Authorization')) {
            return json_encode(['error' => 'No Developer Token Supplied']);
        }

        if (! Developer::where('developer_token', '=', $request->header('Authorization'))->first()) {
            return json_encode(['error' => 'Developer Token incorrect']);
        }

        $query = DB::connection('mysql')
            ->table('trafficlog');

        ParameterBuilder::ParameterBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getErrorLog(Request $request)
    {
        if (! $request->header('Authorization')) {
            return json_encode(['error' => 'No Developer Token Supplied']);
        }

        if (! Developer::where('developer_token', '=', $request->header('Authorization'))->first()) {
            return json_encode(['error' => 'Developer Token incorrect']);
        }

        $query = DB::connection('mysql')
            ->table('errorlog');

        ParameterBuilder::ParameterBuilder($query, $request);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function storeErrorLog(Request $request)
    {
        if (! $request->header('Authorization')) {
            return json_encode(['error' => 'No Developer Token Supplied']);
        }

        if (! Developer::where('developer_token', '=', $request->header('Authorization'))->first()) {
            return json_encode(['error' => 'Developer Token incorrect']);
        }

        $requestData = $request->all();

        $developer = Developer::where('developer_token', '=', $request->header('Authorization'))->first();
        $requestData['ip'] = isset($requestData['ip']) ? $requestData['ip'] : strval($request->ip());
        $requestData['developerId'] = $developer->id;
        $requestData['application'] = $developer->company_name;

        $recordData = ErrorLog::create($requestData);

        return ControllerHelper::PostPutDeleteFormatHelper($recordData, $request);
    }

    public function getApiTrafficLog(Request $request)
    {
        $query = DB::connection('mysql')
            ->table('apitrafficlog');

        // $query = DataTables::eloquent($x);

        ParameterBuilder::ParameterBuilder($query, $request);

        // ParameterBuilder::DefaultMatterBuilder($query);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }
        //  return DataTables::eloquent($query)
        //         ->setTotalRecords(100)
        //         ->toJson();
        // return datatables()->of($query)->orderColumn('FileRef', 'asc')->setTotalRecords(1)->toJson();
        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getCompanies(Request $request)
    {
        $query = DB::connection('mysql')
            ->table('companies');

        ParameterBuilder::ParameterBuilder($query, $request);

        if (method_exists('App\Custom\QueryBuilder', 'DefaultCompanyBuilder')) {
            ParameterBuilder::DefaultCompanyBuilder($query);
        }

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return ControllerHelper::DataFormatHelper($query, $request);
    }

    public function getCompany(Request $request)
    {
        $query = DB::connection('mysql')
            ->table('companies');

        ParameterBuilder::ParameterBuilder($query, $request);

        if (method_exists('App\Custom\QueryBuilder', 'DefaultCompanyBuilder')) {
            ParameterBuilder::DefaultCompanyBuilder($query);
        }

        $query->where('Company.RecordID', $request->id);

        if ($request->input('method')) {
            return ControllerHelper::MethodHelper($query, $request);
        }

        return $query->get()->toJson();
    }

    public function updateCompany(Request $request)
    {
        $recordData = Company::findorFail($request->id);
        $recordData->update($request->all());
        $recordData->save();

        return $recordData;
    }

    public function getUserData(Request $request)
    {
        // $user = $request->user();
        $loginID = $request->loginID;
        $company = $request->company;

        // return $company;

        $queryEmployee = DB::connection('sqlsrv')
        ->table('Employee')
        ->select('name', 'EmailAddress', 'Email', 'Telephone', 'Fax', 'CellPhone', 'IdentityNumber')
        ->where('Employee.loginID', $loginID);

        $queryControl = DB::connection('sqlsrv')
        ->table('Control')
        ->select('Name', 'Telephone', 'Fax', 'EMail');

        $queryEmployeeResult = $queryEmployee->get();
        $queryControlResult = $queryControl->get();

        $returnData['employee'] = $queryEmployeeResult;
        $returnData['company'] = $queryControlResult;

        return $returnData;
    }
}
