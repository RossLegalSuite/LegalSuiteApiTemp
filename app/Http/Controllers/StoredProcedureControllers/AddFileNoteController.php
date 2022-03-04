<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class AddFileNoteController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('AddFileNote');
            $returnData['data']['number of parameters'] = '9';
            $returnData['data']['parameters'] = json_decode('[{"name":"@MatterID","type":"int"},{"name":"@EmployeeId","type":"int"},{"name":"@Description","type":"varchar"},{"name":"@TheDate","type":"int"},{"name":"@TheTime","type":"int"},{"name":"@InternalFlag","type":"int"},{"name":"@CreatedDate","type":"int"},{"name":"@CreatedTime","type":"int"},{"name":"@CreatedBy","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC AddFileNote	@matterid="'.$request->matterid.'",@employeeid="'.$request->employeeid.'",@description="'.$request->description.'",@thedate="'.$request->thedate.'",@thetime="'.$request->thetime.'",@internalflag="'.$request->internalflag.'",@createddate="'.$request->createddate.'",@createdtime="'.$request->createdtime.'",@createdby="'.$request->createdby.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
