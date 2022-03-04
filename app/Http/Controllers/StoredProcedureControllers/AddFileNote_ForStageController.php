<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AddFileNote_ForStageController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AddFileNote_ForStage');
			$returnData['data']['number of parameters'] = '5';
			$returnData['data']['parameters'] = json_decode('[{"name":"@EmployeeId","type":"int"},{"name":"@Description","type":"varchar"},{"name":"@FromStage","type":"varchar"},{"name":"@ToStage","type":"varchar"},{"name":"@Days","type":"int"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AddFileNote_ForStage	@employeeid="'.$request->employeeid.'",@description="'.$request->description.'",@fromstage="'.$request->fromstage.'",@tostage="'.$request->tostage.'",@days="'.$request->days.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

