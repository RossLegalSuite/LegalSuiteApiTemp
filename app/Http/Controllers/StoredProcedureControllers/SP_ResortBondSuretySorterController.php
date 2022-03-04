<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class SP_ResortBondSuretySorterController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('SP_ResortBondSuretySorter');
			$returnData['data']['number of parameters'] = '1';
			$returnData['data']['parameters'] = json_decode('[{"name":"@MatterID","type":"int"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC SP_ResortBondSuretySorter	@matterid='.$request->matterid);

			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

