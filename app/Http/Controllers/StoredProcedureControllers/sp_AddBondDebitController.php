<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_AddBondDebitController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_AddBondDebit');
            $returnData['data']['number of parameters'] = '5';
            $returnData['data']['parameters'] = json_decode('[{"name":"@Type","type":"char"},{"name":"@TheMatter","type":"varchar"},{"name":"@Description","type":"varchar"},{"name":"@Amount","type":"decimal"},{"name":"@VatFlag","type":"tinyint"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC sp_AddBondDebit	@type="'.$request->type.'",@thematter="'.$request->thematter.'",@description="'.$request->description.'",@amount="'.$request->amount.'",@vatflag="'.$request->vatflag.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
