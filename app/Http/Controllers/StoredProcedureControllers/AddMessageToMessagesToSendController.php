<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AddMessageToMessagesToSendController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AddMessageToMessagesToSend');
			$returnData['data']['number of parameters'] = '1';
			$returnData['data']['parameters'] = json_decode('[{"name":"@message","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AddMessageToMessagesToSend	@message='.$request->message);

			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

