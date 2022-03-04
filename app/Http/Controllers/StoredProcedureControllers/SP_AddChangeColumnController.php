<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class SP_AddChangeColumnController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('SP_AddChangeColumn');
			$returnData['data']['number of parameters'] = '4';
			$returnData['data']['parameters'] = json_decode('[{"name":"@Table","type":"nvarchar"},{"name":"@Col","type":"nvarchar"},{"name":"@Type","type":"nvarchar"},{"name":"@Null","type":"nvarchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC SP_AddChangeColumn	@table="'.$request->table.'",@col="'.$request->col.'",@type="'.$request->type.'",@null="'.$request->null.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

