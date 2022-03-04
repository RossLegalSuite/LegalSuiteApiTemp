<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AppointmentByDateController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('AppointmentByDate');
            $returnData['data']['number of parameters'] = '3';
            $returnData['data']['parameters'] = json_decode('[{"name":"@EmployeeID","type":"int"},{"name":"@FromDate","type":"datetime"},{"name":"@ToDate","type":"datetime"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->select('EXEC AppointmentByDate	@employeeid="'.$request->employeeid.'",@fromdate="'.$request->fromdate.'",@todate="'.$request->todate.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
