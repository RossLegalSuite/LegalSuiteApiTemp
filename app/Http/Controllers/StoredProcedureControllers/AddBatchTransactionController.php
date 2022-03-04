<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AddBatchTransactionController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AddBatchTransaction');
			$returnData['data']['number of parameters'] = '19';
			$returnData['data']['parameters'] = json_decode('[{"name":"@TheType","type":"char"},{"name":"@TheBatchId","type":"int"},{"name":"@TheCode1","type":"varchar"},{"name":"@Description","type":"varchar"},{"name":"@Amount","type":"decimal"},{"name":"@VatRate","type":"char"},{"name":"@VatIE","type":"char"},{"name":"@Voucher","type":"varchar"},{"name":"@Code2","type":"int"},{"name":"@EmployeeId","type":"int"},{"name":"@CostCentreId","type":"int"},{"name":"@TheDate","type":"char"},{"name":"@Period","type":"tinyint"},{"name":"@Year","type":"int"},{"name":"@FeeType","type":"tinyint"},{"name":"@AgentFlag","type":"tinyint"},{"name":"@SendToDebtor","type":"tinyint"},{"name":"@BuyerSeller","type":"char"},{"name":"@FeeNoteId","type":"int"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AddBatchTransaction	@thetype="'.$request->thetype.'",@thebatchid="'.$request->thebatchid.'",@thecode1="'.$request->thecode1.'",@description="'.$request->description.'",@amount="'.$request->amount.'",@vatrate="'.$request->vatrate.'",@vatie="'.$request->vatie.'",@voucher="'.$request->voucher.'",@code2="'.$request->code2.'",@employeeid="'.$request->employeeid.'",@costcentreid="'.$request->costcentreid.'",@thedate="'.$request->thedate.'",@period="'.$request->period.'",@year="'.$request->year.'",@feetype="'.$request->feetype.'",@agentflag="'.$request->agentflag.'",@sendtodebtor="'.$request->sendtodebtor.'",@buyerseller="'.$request->buyerseller.'",@feenoteid="'.$request->feenoteid.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

