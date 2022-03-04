<?php

namespace App\Http\Controllers\StoredProcedureControllers;

use App\Http\Controllers\Controller;
use App\Custom\ControllerHelper;
use DB;
use Illuminate\Http\Request;

class AddMatPartyController extends Controller
{


	public function parameters(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$returnData['data']['store producure name'] = strtolower('AddMatParty');
			$returnData['data']['number of parameters'] = '53';
			$returnData['data']['parameters'] = json_decode('[{"name":"@PartyID","type":"int"},{"name":"@MatterID","type":"int"},{"name":"@RoleID","type":"int"},{"name":"@RecordID","type":"int"},{"name":"@AttorneyId","type":"int"},{"name":"@Balance","type":"decimal"},{"name":"@CaseNo","type":"varchar"},{"name":"@ClaimAmount","type":"decimal"},{"name":"@ClaimDescription","type":"varchar"},{"name":"@ClaimOption","type":"tinyint"},{"name":"@ComplianceStatus","type":"tinyint"},{"name":"@ConnectedParty","type":"char"},{"name":"@ContactID","type":"int"},{"name":"@ContactRelationshipID","type":"int"},{"name":"@CourtOrderDetails","type":"varchar"},{"name":"@DistributedAmount","type":"decimal"},{"name":"@DistributionPercent","type":"decimal"},{"name":"@District","type":"varchar"},{"name":"@EffectiveDate","type":"int"},{"name":"@EmployerAddress","type":"varchar"},{"name":"@EmployerName","type":"varchar"},{"name":"@EmployerTele","type":"varchar"},{"name":"@EmploymentStatus","type":"varchar"},{"name":"@HeldBack","type":"decimal"},{"name":"@IncludeInLifeAssurance","type":"char"},{"name":"@InstalmentAmount","type":"decimal"},{"name":"@InstalmentFrequency","type":"char"},{"name":"@LanguageID","type":"int"},{"name":"@MatterDescription","type":"varchar"},{"name":"@MaxClaimAmount","type":"decimal"},{"name":"@NOCapacity","type":"varchar"},{"name":"@NOFlag","type":"tinyint"},{"name":"@NOPrincipal","type":"varchar"},{"name":"@Notification_Method_X","type":"varchar"},{"name":"@PaidOutBFwd","type":"decimal"},{"name":"@PartyRelationshipID","type":"int"},{"name":"@PayableFrom","type":"int"},{"name":"@PayableTo","type":"int"},{"name":"@RateCustomerRole","type":"varchar"},{"name":"@RateEstateType","type":"varchar"},{"name":"@RatePerminantResident","type":"char"},{"name":"@RatePORTION_SHARE_P","type":"decimal"},{"name":"@RatePrimaryApplicant","type":"char"},{"name":"@RateSurityIndicator","type":"char"},{"name":"@Reference","type":"varchar"},{"name":"@RelativeAddress","type":"varchar"},{"name":"@RelativeFullName","type":"varchar"},{"name":"@RelativeTele","type":"varchar"},{"name":"@SARS_SharePercentage","type":"decimal"},{"name":"@Sorter","type":"int"},{"name":"@SuretyAmount","type":"decimal"},{"name":"@SuretySecurity","type":"varchar"},{"name":"@SuretyUnlimitedFlag","type":"tinyint"}]');
			return $returnData;
		
		});

	}

	public function execute(Request $request)
	{
		return ControllerHelper::tryCatch($request, function ($request) {
		
			$responseObject = DB::connection('sqlsrv')->statement('EXEC AddMatParty	@partyid="'.$request->partyid.'",@matterid="'.$request->matterid.'",@roleid="'.$request->roleid.'",@recordid="'.$request->recordid.'",@attorneyid="'.$request->attorneyid.'",@balance="'.$request->balance.'",@caseno="'.$request->caseno.'",@claimamount="'.$request->claimamount.'",@claimdescription="'.$request->claimdescription.'",@claimoption="'.$request->claimoption.'",@compliancestatus="'.$request->compliancestatus.'",@connectedparty="'.$request->connectedparty.'",@contactid="'.$request->contactid.'",@contactrelationshipid="'.$request->contactrelationshipid.'",@courtorderdetails="'.$request->courtorderdetails.'",@distributedamount="'.$request->distributedamount.'",@distributionpercent="'.$request->distributionpercent.'",@district="'.$request->district.'",@effectivedate="'.$request->effectivedate.'",@employeraddress="'.$request->employeraddress.'",@employername="'.$request->employername.'",@employertele="'.$request->employertele.'",@employmentstatus="'.$request->employmentstatus.'",@heldback="'.$request->heldback.'",@includeinlifeassurance="'.$request->includeinlifeassurance.'",@instalmentamount="'.$request->instalmentamount.'",@instalmentfrequency="'.$request->instalmentfrequency.'",@languageid="'.$request->languageid.'",@matterdescription="'.$request->matterdescription.'",@maxclaimamount="'.$request->maxclaimamount.'",@nocapacity="'.$request->nocapacity.'",@noflag="'.$request->noflag.'",@noprincipal="'.$request->noprincipal.'",@notification_method_x="'.$request->notification_method_x.'",@paidoutbfwd="'.$request->paidoutbfwd.'",@partyrelationshipid="'.$request->partyrelationshipid.'",@payablefrom="'.$request->payablefrom.'",@payableto="'.$request->payableto.'",@ratecustomerrole="'.$request->ratecustomerrole.'",@rateestatetype="'.$request->rateestatetype.'",@rateperminantresident="'.$request->rateperminantresident.'",@rateportion_share_p="'.$request->rateportion_share_p.'",@rateprimaryapplicant="'.$request->rateprimaryapplicant.'",@ratesurityindicator="'.$request->ratesurityindicator.'",@reference="'.$request->reference.'",@relativeaddress="'.$request->relativeaddress.'",@relativefullname="'.$request->relativefullname.'",@relativetele="'.$request->relativetele.'",@sars_sharepercentage="'.$request->sars_sharepercentage.'",@sorter="'.$request->sorter.'",@suretyamount="'.$request->suretyamount.'",@suretysecurity="'.$request->suretysecurity.'",@suretyunlimitedflag="'.$request->suretyunlimitedflag.'"');
			return ControllerHelper::StoredProcedureFormatHelper($responseObject, $request);		
		});

	}

} 

