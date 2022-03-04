<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_helpdiagramdefinitionController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_helpdiagramdefinition');
            $returnData['data']['number of parameters'] = '2';
            $returnData['data']['parameters'] = json_decode('[{"name":"@diagramname","type":"sysname"},{"name":"@owner_id","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC sp_helpdiagramdefinition	@diagramname="'.$request->diagramname.'",@owner_id="'.$request->owner_id.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
