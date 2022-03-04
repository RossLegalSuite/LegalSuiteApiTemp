<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class Send_CDOSysMailController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('Send_CDOSysMail');
			$returnData['data']['number of parameters'] = '5';
			$returnData['data']['parameters'] = json_decode('[{"name":"@From","type":"varchar"},{"name":"@To","type":"varchar"},{"name":"@Subject","type":"varchar"},{"name":"@Body","type":"varchar"},{"name":"@Attachment","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC Send_CDOSysMail	@from="'.$request->from.'",@to="'.$request->to.'",@subject="'.$request->subject.'",@body="'.$request->body.'",@attachment="'.$request->attachment.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

