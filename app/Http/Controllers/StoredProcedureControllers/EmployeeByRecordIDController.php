<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class EmployeeByRecordIDController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('EmployeeByRecordID');
			$returnData['data']['number of parameters'] = '1';
			$returnData['data']['parameters'] = json_decode('[{"name":"@EmployeeID","type":"int"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->select('EXEC EmployeeByRecordID	@employeeid='.$request->employeeid);

			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 
