<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class proc_FilltblUnusedIndexesController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('proc_FilltblUnusedIndexes');
			$returnData['data']['number of parameters'] = '2';
			$returnData['data']['parameters'] = json_decode('[{"name":"@IndexUsageToSizeRatio","type":"decimal"},{"name":"@indexusage","type":"int"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC proc_FilltblUnusedIndexes	@indexusagetosizeratio="'.$request->indexusagetosizeratio.'",@indexusage="'.$request->indexusage.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

