<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class UpdateActivationDetailsController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('UpdateActivationDetails');
            $returnData['data']['number of parameters'] = '2';
            $returnData['data']['parameters'] = json_decode('[{"name":"@AttorneyKref","type":"varchar"},{"name":"@AttorneyKeypair","type":"varchar"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC UpdateActivationDetails	@attorneykref="'.$request->attorneykref.'",@attorneykeypair="'.$request->attorneykeypair.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
