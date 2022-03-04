<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AppointmentUpdateController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('AppointmentUpdate');
            $returnData['data']['number of parameters'] = '12';
            $returnData['data']['parameters'] = json_decode('[{"name":"@RecordID","type":"int"},{"name":"@EmployeeID","type":"int"},{"name":"@Date","type":"datetime"},{"name":"@StartTime","type":"smallint"},{"name":"@EndTime","type":"smallint"},{"name":"@Description","type":"varchar"},{"name":"@Colour","type":"int"},{"name":"@RemindIcon","type":"smallint"},{"name":"@TentativeFlag","type":"smallint"},{"name":"@PrivateIcon","type":"smallint"},{"name":"@LocateIcon","type":"smallint"},{"name":"@Location","type":"varchar"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC AppointmentUpdate	@recordid="'.$request->recordid.'",@employeeid="'.$request->employeeid.'",@date="'.$request->date.'",@starttime="'.$request->starttime.'",@endtime="'.$request->endtime.'",@description="'.$request->description.'",@colour="'.$request->colour.'",@remindicon="'.$request->remindicon.'",@tentativeflag="'.$request->tentativeflag.'",@privateicon="'.$request->privateicon.'",@locateicon="'.$request->locateicon.'",@location="'.$request->location.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
