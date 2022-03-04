<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_CreateFileRefController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_CreateFileRef');
            $returnData['data']['number of parameters'] = '2';
            $returnData['data']['parameters'] = json_decode('[{"name":"@MatterPrefix","type":"varchar"},{"name":"@FileRef","type":"varchar"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->select('EXEC sp_CreateFileRef	@matterprefix="'.$request->matterprefix.'",@fileref="'.$request->fileref.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
