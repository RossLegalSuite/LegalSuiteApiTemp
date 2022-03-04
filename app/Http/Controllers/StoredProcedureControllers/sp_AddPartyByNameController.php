<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Custom\ControllerHelper;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;

class sp_AddPartyByNameController extends Controller
{
    public function parameters(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $returnData['data']['store producure name'] = strtolower('sp_AddPartyByName');
            $returnData['data']['number of parameters'] = '18';
            $returnData['data']['parameters'] = json_decode('[{"name":"@Name","type":"varchar"},{"name":"@RoleID","type":"int"},{"name":"@EntityID","type":"int"},{"name":"@PartyTypeID","type":"int"},{"name":"@Notes","type":"varchar"},{"name":"@PhoneCell","type":"varchar"},{"name":"@PhoneWork","type":"varchar"},{"name":"@PhoneFax","type":"varchar"},{"name":"@PhoneEmail","type":"varchar"},{"name":"@PostalLine1","type":"varchar"},{"name":"@PostalLine2","type":"varchar"},{"name":"@PostalLine3","type":"varchar"},{"name":"@PostalCode","type":"varchar"},{"name":"@PhysicalLine1","type":"varchar"},{"name":"@PhysicalLine2","type":"varchar"},{"name":"@PhysicalLine3","type":"varchar"},{"name":"@PhysicalCode","type":"varchar"},{"name":"@PartyID","type":"int"}]');

            return $returnData;
        });
    }

    public function execute(Request $request)
    {
        return ControllerHelper::tryCatch($request, function ($request) {
            $responseObject = DB::connection('sqlsrv')->statement('EXEC sp_AddPartyByName	@name="'.$request->name.'",@roleid="'.$request->roleid.'",@entityid="'.$request->entityid.'",@partytypeid="'.$request->partytypeid.'",@notes="'.$request->notes.'",@phonecell="'.$request->phonecell.'",@phonework="'.$request->phonework.'",@phonefax="'.$request->phonefax.'",@phoneemail="'.$request->phoneemail.'",@postalline1="'.$request->postalline1.'",@postalline2="'.$request->postalline2.'",@postalline3="'.$request->postalline3.'",@postalcode="'.$request->postalcode.'",@physicalline1="'.$request->physicalline1.'",@physicalline2="'.$request->physicalline2.'",@physicalline3="'.$request->physicalline3.'",@physicalcode="'.$request->physicalcode.'",@partyid="'.$request->partyid.'"');

            return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);
        });
    }
}
