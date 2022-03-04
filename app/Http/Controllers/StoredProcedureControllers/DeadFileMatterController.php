<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class DeadFileMatterController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('DeadFileMatter');
            $returnData['data']['number of parameters'] = '1';
            $returnData['data']['parameters'] = json_decode('[{"name":"@MatterId","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC DeadFileMatter	@matterid='.$request->matterid);

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
