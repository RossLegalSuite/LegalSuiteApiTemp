<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class conveydata extends Model
{
    protected $primaryKey = 'MatterID';

    protected $table = 'ConveyData';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'matterid',
        'entomologistflag',
        'entomologistdate',
        'electricalflag',
        'electricaldate',
        'depositamount',
        'depositduedate',
        'depositpaiddate',
        'occupationalrent',
        'bondgranteddate',
        'entomologistamount',
        'electricalamount',
        'occupationdate',
        'buyergpasignedat',
        'buyergpasignedby',
        'buyergpasignedon',
        'sellergpasignedat',
        'sellergpasignedby',
        'sellergpasignedon',
        'sellergpaflag',
        'buyergpaflag',
        'propertydescription',
        'occup_i_on',
        'occup_d',
        'proformaheading',
        'buyerheading',
        'sellerheading',
        'sellersfutureaddress',
        'usecorrespondentflag',
        'guaranteetotal',
        'deedofficesearchfee',
        'ficafee',
        'buyergpatype',
        'sellergpatype',
        'surveyorgeneralamount',
        'schemedeednumber',
        'schemediagramnumber',
        'bodycorptrustees',
        'schemeextentiondescription',
        'schemeextentioncertificateno',
        'schemeextentionyears',
        'schemeextentionsubsection',
        'buyersfutureaddress',
        'sbsa_ins_y',
        'buyersfutureaddressline1',
        'buyersfutureaddressline2',
        'buyersfutureaddressline3',
        'buyersfutureaddresspostalcode',
        'sellersfutureaddressline1',
        'sellersfutureaddressline2',
        'sellersfutureaddressline3',
        'sellersfutureaddresspostalcode',
        'streetaddressline1',
        'streetaddressline2',
        'streetaddressline3',
        'streetaddresspostalcode',
        'estatestatus',
        'estatevalue',
        'estatecausa',
        'estatesection',
        'willclausedescription',
        'listingagentcommissionamount',
        'listingagentcommissionpercent',
        'listingagentid',
        'listingagentflag',
        'fnbdivision',
        'step1target',
        'step2target',
        'step3target',
        'step4target',
        'step5target',
        'step6target',
        'step7target',
        'step1completed',
        'step2completed',
        'step3completed',
        'step4completed',
        'step5completed',
        'step6completed',
        'step7completed',
        'targetlodgementdate',
        'sbsa_init_fee_paid',
        'bondtypeid',
        'primaryresidenceflag',
        'linkedtransactionflag',
        'linkedtransactiondate',
        'expectedtransferdate',
        'penaltyperiodflag',
        'penaltyperioddate',
        'outsideinsuranceflag',
        'initiationfeeoption',
        'bridgingfinanceflag',
        'preferredcommunicationoption',
        'suretyflag',
        'sellerpreferredcommunicationoption',
        'buyerpreferredcommunicationoption',
        'proceedsbranch',
        'proceedsaccountname',
        'proceedsaccountno',
        'proceedspaidoption',
        'consentgeneraldescription',
        'consentnewbondholder',
        'consentnewbondnumber',
        'consentcapitalamount',
        'consentadditionalamount',
        'consentpropertydescription',
        'consentmortgagor',
        'consentranking',
        'consentdocumentname',
        'consentdocumentmistake',
        'consentdocumentcorrection',
        'causeofaction',
        'loantype',
        'dotrackingnumber',
        'waiveroption',
        'transactiontypeid',
        'deedsofficeid',
        'transactiontype',
        'senttolawdeedflag',
        'levyclearance',
        'lodgingagentparalegalid',
        'causeofactionwording',
        'bondcauseid',
        'proformadiscountamount',
        'conditions',
        'consenttypeid',
        'commissionexcludesvatflag',
        'listingagentcommissionexcludesvatflag',
        'datepropertyacquired',
        'originalpurchaseprice',
        'absa_insurancevalue',
        'absa_annualinsurancepremium',
        'absa_feeamount',
        'absa_complaintemail',
        'absa_complianceemail',
        'absa_ombudemail',
        'checklistinsertedflag',
        'ficaflag',
        'boughtby',
        'propertytype',
        'propertytypespecify',
        'buyernonresident',
        'transferdutycalculatedby',
        'buyersellerconnected',
        'mortgageoriginatorid',
        'attorneyclassificationid',
        'costspaidby',
        'court',
        'bondcausedetailsid',
        'endorsementid',
        'bodycorporateflag',
        'rightregflag',
        'rightsaleflag',
        'cessionflag',
        'debitorderflag',
        'waiveroflienflag',
        'variationflag',
        'rightlapsedflag',
        'shareblockoption',
        'shareblocknumber',
        'shareblockvalue',
        'groupid',
        'shareblockcompanysignatory',
        'shareblockcompanyname',
        'shareblockcompanyregno',
        'deedsofficecessionfee',
        'bankbranch',
        'bankcontactperson',
        'bankcontacttelephone',
        'fairvalue',
        'transferdutypenalty',
        'estateinfavourof',
        'jointestateflag',
        'commissionpaidby',
        'tdonarrearratesflag',
        'tdonarrearleviesflag',
        'existingbondholder',
        'schemetype',
        'phasedescription',
        'sellerdeveloperflag',
        'unitratedflag',
        'landvalue',
        'improvementsvalue',
        'sarsreference',
        'gasflag',
        'gasdate',
        'gasamount',
        'plumbingflag',
        'plumbingdate',
        'plumbingamount',
        'insurancecompanyid',
        'propertyusedfor',
        'valueofproperty',
        'monthlyrentalvalue',
        'section9exemptionflag',
        'section9exemption',
        'anotheractexemption',
        'vatpurposeind',
        'inputtaxclaimedind',
        'vatrateind',
        'includingvatind',
        'vatpayableamt',
        'vatdeclarationperiod',
        'outputtaxpayableamt',
        'goingconcernpayableamt',
        'vdpindicator',
        'vdpapplicationno',
        'consentdetails',
        'partpaymentamount',
        'section35aapplicable',
        'listingagentpersonid',
        'listingagentpersonflag',
        'completiondate',
        'collateralamount',
        'loanamount',
        'war_rate_p',
        'crw_p',
        'frstm_home_buyr_y',
        'low_incom_housg',
        'guaranteehubflag',
        'lastamendmentreceiveddate',
        'sbsa_produce_new_clf_docs',
        'indemnitybondindicator',
        'newbondholder',
        'contractregistrationdate',
        'electricfenceflag',
        'electricfencedate',
        'electricfenceamount',
        'act81appliesflag',
        'mortgageecode',
        'ned_generalrequirementcodes',
        'ned_requirementcodes',
        'schemegeneralplannumber',
        'schemeextensiontype',
        'schemeeuadeednumber',
        'schemeeuaholdingdeeddate',
        'schemeextentofdevundividedshare',
        'schemeextentofdevundividedshareunitflag',
        'bodycorporatemoneyflag',
        'resolutiontype',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
