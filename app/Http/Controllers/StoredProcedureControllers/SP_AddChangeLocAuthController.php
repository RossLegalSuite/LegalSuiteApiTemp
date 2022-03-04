<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class SP_AddChangeLocAuthController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('SP_AddChangeLocAuth');
			$returnData['data']['number of parameters'] = '4';
			$returnData['data']['parameters'] = json_decode('[{"name":"@Description","type":"nvarchar"},{"name":"@DeedsOffice","type":"nvarchar"},{"name":"@Code","type":"nvarchar"},{"name":"@FriendlyName","type":"nvarchar"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC SP_AddChangeLocAuth	@description="'.$request->description.'",@deedsoffice="'.$request->deedsoffice.'",@code="'.$request->code.'",@friendlyname="'.$request->friendlyname.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

