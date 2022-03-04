<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AppointToDoInsertController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AppointToDoInsert');
			$returnData['data']['number of parameters'] = '6';
			$returnData['data']['parameters'] = json_decode('[{"name":"@EmployeeID","type":"int"},{"name":"@Priority","type":"tinyint"},{"name":"@Description","type":"varchar"},{"name":"@CompletionDate","type":"datetime"},{"name":"@CompletedFlag","type":"tinyint"},{"name":"@Notes","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AppointToDoInsert	@employeeid="'.$request->employeeid.'",@priority="'.$request->priority.'",@description="'.$request->description.'",@completiondate="'.$request->completiondate.'",@completedflag="'.$request->completedflag.'",@notes="'.$request->notes.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

