<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class proc_DropUnusedIndexController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('proc_DropUnusedIndex');
            $returnData['data']['number of parameters'] = '1';
            $returnData['data']['parameters'] = json_decode('[{"name":"@UnusedIndID","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC proc_DropUnusedIndex	@unusedindid='.$request->unusedindid);

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
