<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class GetConstraintScriptsController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('GetConstraintScripts');
			$returnData['data']['number of parameters'] = '2';
			$returnData['data']['parameters'] = json_decode('[{"name":"@Table","type":"nvarchar"},{"name":"@Col","type":"nvarchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->select('EXEC GetConstraintScripts	@table="'.$request->table.'",@col="'.$request->col.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

