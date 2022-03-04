<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class sp_alterdiagramController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('sp_alterdiagram');
			$returnData['data']['number of parameters'] = '4';
			$returnData['data']['parameters'] = json_decode('[{"name":"@diagramname","type":"sysname"},{"name":"@owner_id","type":"int"},{"name":"@version","type":"int"},{"name":"@definition","type":"varbinary"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC sp_alterdiagram	@diagramname="'.$request->diagramname.'",@owner_id="'.$request->owner_id.'",@version="'.$request->version.'",@definition="'.$request->definition.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

