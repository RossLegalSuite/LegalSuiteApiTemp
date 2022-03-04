<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class lsw_CheckMATTransferController extends Controller
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
            $responseObject = DB::connection('sqlsrv')->select('EXEC lsw_CheckMATTransfer');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
