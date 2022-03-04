<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AddFeenoteController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('AddFeenote');
            $returnData['data']['number of parameters'] = '17';
            $returnData['data']['parameters'] = json_decode('[{"name":"@Type","type":"char"},{"name":"@TheMatter","type":"varchar"},{"name":"@Description","type":"varchar"},{"name":"@Amount","type":"decimal"},{"name":"@VatRate","type":"char"},{"name":"@VatIE","type":"char"},{"name":"@Voucher","type":"varchar"},{"name":"@Code2","type":"int"},{"name":"@EmployeeId","type":"int"},{"name":"@CostCentreId","type":"int"},{"name":"@TheDate","type":"char"},{"name":"@Period","type":"tinyint"},{"name":"@Year","type":"int"},{"name":"@FeeType","type":"tinyint"},{"name":"@AgentFlag","type":"tinyint"},{"name":"@SendToDebtor","type":"tinyint"},{"name":"@BuyerSeller","type":"char"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC AddFeenote	@type="'.$request->type.'",@thematter="'.$request->thematter.'",@description="'.$request->description.'",@amount="'.$request->amount.'",@vatrate="'.$request->vatrate.'",@vatie="'.$request->vatie.'",@voucher="'.$request->voucher.'",@code2="'.$request->code2.'",@employeeid="'.$request->employeeid.'",@costcentreid="'.$request->costcentreid.'",@thedate="'.$request->thedate.'",@period="'.$request->period.'",@year="'.$request->year.'",@feetype="'.$request->feetype.'",@agentflag="'.$request->agentflag.'",@sendtodebtor="'.$request->sendtodebtor.'",@buyerseller="'.$request->buyerseller.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
