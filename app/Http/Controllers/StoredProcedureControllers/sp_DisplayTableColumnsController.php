<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class sp_DisplayTableColumnsController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('sp_DisplayTableColumns');
			$returnData['data']['number of parameters'] = '1';
			$returnData['data']['parameters'] = json_decode('[{"name":"@TableName","type":"varchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->select('EXEC sp_DisplayTableColumns	@tablename='.$request->tablename);

			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

