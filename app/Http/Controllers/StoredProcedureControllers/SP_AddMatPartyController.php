<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class SP_AddMatPartyController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('SP_AddMatParty');
            $returnData['data']['number of parameters'] = '4';
            $returnData['data']['parameters'] = json_decode('[{"name":"@MatterID","type":"int"},{"name":"@PartyID","type":"int"},{"name":"@RoleID","type":"int"},{"name":"@Reference","type":"varchar"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC SP_AddMatParty	@matterid="'.$request->matterid.'",@partyid="'.$request->partyid.'",@roleid="'.$request->roleid.'",@reference="'.$request->reference.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
