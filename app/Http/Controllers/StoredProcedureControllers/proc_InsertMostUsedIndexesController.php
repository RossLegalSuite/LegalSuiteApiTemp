<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class proc_InsertMostUsedIndexesController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('proc_InsertMostUsedIndexes');
            $returnData['data']['number of parameters'] = '2';
            $returnData['data']['parameters'] = json_decode('[{"name":"@IndexUSageToSizeRatio","type":"decimal"},{"name":"@indexusage","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC proc_InsertMostUsedIndexes	@indexusagetosizeratio="'.$request->indexusagetosizeratio.'",@indexusage="'.$request->indexusage.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
