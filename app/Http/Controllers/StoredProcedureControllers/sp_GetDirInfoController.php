<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_GetDirInfoController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_GetDirInfo');
            $returnData['data']['number of parameters'] = '5';
            $returnData['data']['parameters'] = json_decode('[{"name":"@vcPrimaryPath","type":"varchar"},{"name":"@tiIncludeSubDir","type":"tinyint"},{"name":"@vcBcpPath","type":"varchar"},{"name":"@cDateType","type":"char"},{"name":"@tiIncludeDir","type":"tinyint"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC sp_GetDirInfo	@vcprimarypath="'.$request->vcprimarypath.'",@tiincludesubdir="'.$request->tiincludesubdir.'",@vcbcppath="'.$request->vcbcppath.'",@cdatetype="'.$request->cdatetype.'",@tiincludedir="'.$request->tiincludedir.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
