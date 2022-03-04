<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class sp_send_cdontsmailController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('sp_send_cdontsmail');
			$returnData['data']['number of parameters'] = '6';
			$returnData['data']['parameters'] = json_decode('[{"name":"@From","type":"varchar"},{"name":"@To","type":"varchar"},{"name":"@Subject","type":"varchar"},{"name":"@Body","type":"varchar"},{"name":"@CC","type":"varchar"},{"name":"@BCC","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC sp_send_cdontsmail	@from="'.$request->from.'",@to="'.$request->to.'",@subject="'.$request->subject.'",@body="'.$request->body.'",@cc="'.$request->cc.'",@bcc="'.$request->bcc.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

