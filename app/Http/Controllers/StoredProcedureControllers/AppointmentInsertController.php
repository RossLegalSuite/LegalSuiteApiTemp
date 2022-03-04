<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AppointmentInsertController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AppointmentInsert');
			$returnData['data']['number of parameters'] = '5';
			$returnData['data']['parameters'] = json_decode('[{"name":"@EmployeeID","type":"int"},{"name":"@Date","type":"datetime"},{"name":"@StartTime","type":"smallint"},{"name":"@EndTime","type":"smallint"},{"name":"@Description","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AppointmentInsert	@employeeid="'.$request->employeeid.'",@date="'.$request->date.'",@starttime="'.$request->starttime.'",@endtime="'.$request->endtime.'",@description="'.$request->description.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

