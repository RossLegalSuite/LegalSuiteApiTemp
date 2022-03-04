<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_GetDocLogCategoryDeedsOfficeRecordIDController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_GetDocLogCategoryDeedsOfficeRecordID');
            $returnData['data']['number of parameters'] = '1';
            $returnData['data']['parameters'] = json_decode('[{"name":"@RecordID","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC sp_GetDocLogCategoryDeedsOfficeRecordID	@recordid='.$request->recordid);

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
