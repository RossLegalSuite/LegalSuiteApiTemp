<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class proc_RebuildSelectedIndexesController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data'] = 'Requires no Parameters';

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC proc_RebuildSelectedIndexes');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
