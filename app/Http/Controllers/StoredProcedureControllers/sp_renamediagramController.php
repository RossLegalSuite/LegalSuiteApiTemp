<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class sp_renamediagramController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('sp_renamediagram');
			$returnData['data']['number of parameters'] = '3';
			$returnData['data']['parameters'] = json_decode('[{"name":"@diagramname","type":"sysname"},{"name":"@owner_id","type":"int"},{"name":"@new_diagramname","type":"sysname"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC sp_renamediagram	@diagramname="'.$request->diagramname.'",@owner_id="'.$request->owner_id.'",@new_diagramname="'.$request->new_diagramname.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

