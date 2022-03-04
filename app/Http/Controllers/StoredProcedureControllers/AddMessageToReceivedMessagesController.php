<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AddMessageToReceivedMessagesController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('AddMessageToReceivedMessages');
            $returnData['data']['number of parameters'] = '2';
            $returnData['data']['parameters'] = json_decode('[{"name":"@message","type":"text"},{"name":"@KorbitecMsgIDRef","type":"bigint"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC AddMessageToReceivedMessages	@message="'.$request->message.'",@korbitecmsgidref="'.$request->korbitecmsgidref.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
