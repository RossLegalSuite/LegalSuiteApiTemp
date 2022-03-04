<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class matter extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Matter';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'fileref',
        'description',
        'clientid',
        'docgenid',
        'mattertypeid',
        'documentlanguageid',
        'employeeid',
        'bankid',
        'extrascreenid',
        'billtypeid',
        'counselusedflag',
        'filecabinet',
        'archiveflag',
        'discount',
        'prescriptiondate',
        'casenumber',
        'access',
        'theirref',
        'contact',
        'salutation',
        'oldcode',
        'dateinstructed',
        'internalcomment',
        'accountcomment',
        'clientfeesheetid',
        'accountslanguageid',
        'status',
        'feeestimate',
        'feenotesonhold',
        'claimamount',
        'interestrate',
        'interestfrom',
        'agentflag',
        'adminfeeflag',
        'interestflag',
        'vatexemptflag',
        'discountsurcharge',
        'receiptoption',
        'invoiceflag',
        'invoiceoption',
        'invoiceoutput',
        'lastinvoiceno',
        'lastinvoicedate',
        'lastinvoiceactual',
        'lastinvoicereserved',
        'lastinvoiceinvested',
        'actual',
        'reserved',
        'invested',
        'agecurrent',
        'age30day',
        'age60day',
        'age90day',
        'age120day',
        'age150day',
        'age180day',
        'transfer',
        'totalfeesoutstanding',
        'periodfeesreceipted',
        'totalfees',
        'totaldisbursements',
        'totalreceipts',
        'totalpayments',
        'totaltransfered',
        'feesthisyear',
        'feeslastyear',
        'interestdue',
        'vatprovision',
        'batchednormal',
        'batchedreserved',
        'batchedinvested',
        'consolidateid',
        'consolidatedflag',
        'costcentreid',
        'overrideincomeaccflag',
        'incomeaccid',
        'trustbankid',
        'archiveno',
        'deleteflag',
        'movementflag',
        'collcommflag',
        'collcommoption',
        'collcommpercent',
        'collcommlimit',
        'movementperiod',
        'adminfeeperiod',
        'postingid',
        'batchid',
        'transid',
        'lineid',
        'debtorsbalance',
        'receiptamount',
        'debtorstotalreceipts',
        'debtorstotalcosts',
        'debtorstotalinterest',
        'interestcompoundedflag',
        'interestoncostsflag',
        'debtorpaymentamount',
        'debtorpaymentday',
        'unconsolidatedactual',
        'unconsolidatedreserved',
        'matterinvestmentid',
        'transferdisb',
        'loddate',
        'summonsdate',
        'returnofservicedate',
        'rdjdate',
        'judgmentdate',
        'writdate',
        's65date',
        'debtorsopeningbalance',
        'totalconsolidatedmatters',
        'todogroupid',
        'interestenddate',
        'emodate',
        'dateofdebt',
        'totaljournal',
        'compoundinterestoption',
        'totaldrtrust',
        'totalcrtrust',
        'totaldrbusiness',
        'totalcrbusiness',
        'sheriffareaid',
        'interestperiod',
        'storagelocation',
        'storagenumber',
        'storagedate',
        'storagetakenoutby',
        'storagetakenoutdate',
        'storagereturndate',
        'debtorfeesheetid',
        'businessbankid',
        'archivestatus',
        'intratescheduleid',
        'commentoption',
        'stagesreached',
        'branchflag',
        'branchid',
        'consolidatedisbursementsflag',
        'adminfeeyear',
        'interestyear',
        'investmentfeeflag',
        'totalfeesthisperiod',
        'totaldisbursementsthisperiod',
        'totalreceiptsthisperiod',
        'alternateref',
        'debtorcollcommpercent',
        'debtorcollcommlimit',
        'debtorcollcommoption',
        'exportflag',
        'createinvoiceflag',
        'totalreceiptsdebtor',
        'totalreceiptsdebtorthisperiod',
        'lastdebtorreceiptamount',
        'lastdebtorreceiptdate',
        'lastclientreceiptamount',
        'lastclientreceiptdate',
        'laststatementdate',
        'lastinvoicebatchid',
        'exportedflag',
        'debtorstotalcommission',
        'debtorstotaldebits',
        'debtorstotalcredits',
        'excludedocumentcostsflag',
        'archivedate',
        'groupid',
        'invoicepartyid',
        'interestonamount',
        's57date',
        'totalfeescurrent',
        'totalfeespaidcurrent',
        'totalfeespaid',
        'totaldisbursementspaid',
        'totaldisbursementspaidcurrent',
        'totaldisbursementscurrent',
        'totaldisbursementsoutstandingbfwd',
        'totalfeesoutstandingbfwd',
        'datewithdrawn',
        'invoiceemail',
        'stagegroupid',
        'receiptpercenttocosts',
        'agreedfeepercent',
        'debtorscapitalbalance',
        'debtorscostsbalance',
        'debtorsinterestbalance',
        'weblinkbankref',
        'payattorneyfirstamount',
        'defaultbillingrateid',
        'lastdistributionno',
        'distributedamount',
        'coldebitfeecodeid',
        'receiptpercenttodate',
        'totalfeesbfwd',
        'totaldisbursementsbfwd',
        'totalpaymentsbfwd',
        'totalreceiptsbfwd',
        'totaljournalbfwd',
        'totaldisbursementsoutstanding',
        'lawref',
        'lawsuite',
        'ignoreinduplumflag',
        'distributiongroup',
        'importantdate',
        'invoicebfwdoption',
        'invoicefeeoption',
        'invoicedisbursementoption',
        'remarks',
        'totalfeesoutstandingly',
        'totalfeespaidthisyear',
        'totaldisbursementsoutstandingly',
        'totaldisbursementspaidthisyear',
        'invoiceformat',
        'feeestimatewarningflag',
        'updatedbyid',
        'conveyancingstatusflag',
        'messagewaitingflag',
        'fnbmatterstate',
        'updatedbydate',
        'updatedbytime',
        'ag_matterkref',
        'laststageid',
        'lawdeedid',
        'excludeunitsonaccountflag',
        'tbdate',
        'tbntudate',
        'absalinkflag',
        'absamatterstate',
        'collcommsplitflag',
        'nturequestdate',
        'ntureceivedate',
        'canceltoreassigndate',
        'ratesinstructionsource',
        'internalcommentoption',
        'cancmatterstate',
        'ag_cancmatterkref',
        'agreedfeelimit',
        'addeddefaultpartiesflag',
        'datalinksuite',
        'debtorpaymentfrequency',
        'ncaflag',
        'tdreferencenum',
        'agentpercent',
        'linkedmatterid',
        'receiptpercent',
        'lawindex',
        'noficaflag',
        'totalfeespaidlastperiod',
        'showprescriptionwarningflag',
        'consolidationoption',
        'thisinvoiceactual',
        'thisinvoicereserved',
        'thisinvoiceinvested',
        'laststagedate',
        'lifeassurance',
        'currentinstalment',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setprescriptiondateAttribute($value)
    {
        $this->attributes['prescriptiondate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setdateinstructedAttribute($value)
    {
        $this->attributes['dateinstructed'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastinvoicedateAttribute($value)
    {
        $this->attributes['lastinvoicedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setloddateAttribute($value)
    {
        $this->attributes['loddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setsummonsdateAttribute($value)
    {
        $this->attributes['summonsdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setreturnofservicedateAttribute($value)
    {
        $this->attributes['returnofservicedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setrdjdateAttribute($value)
    {
        $this->attributes['rdjdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setjudgmentdateAttribute($value)
    {
        $this->attributes['judgmentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setwritdateAttribute($value)
    {
        $this->attributes['writdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets65dateAttribute($value)
    {
        $this->attributes['s65date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setinterestenddateAttribute($value)
    {
        $this->attributes['interestenddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemodateAttribute($value)
    {
        $this->attributes['emodate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setdateofdebtAttribute($value)
    {
        $this->attributes['dateofdebt'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setstoragedateAttribute($value)
    {
        $this->attributes['storagedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setstoragetakenoutdateAttribute($value)
    {
        $this->attributes['storagetakenoutdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setstoragereturndateAttribute($value)
    {
        $this->attributes['storagereturndate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastdebtorreceiptdateAttribute($value)
    {
        $this->attributes['lastdebtorreceiptdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastclientreceiptdateAttribute($value)
    {
        $this->attributes['lastclientreceiptdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlaststatementdateAttribute($value)
    {
        $this->attributes['laststatementdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setarchivedateAttribute($value)
    {
        $this->attributes['archivedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets57dateAttribute($value)
    {
        $this->attributes['s57date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setdatewithdrawnAttribute($value)
    {
        $this->attributes['datewithdrawn'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setreceiptpercenttodateAttribute($value)
    {
        $this->attributes['receiptpercenttodate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setimportantdateAttribute($value)
    {
        $this->attributes['importantdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setinterestfromAttribute($value)
    {
        $this->attributes['interestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setupdatedbydateAttribute($value)
    {
        $this->attributes['updatedbydate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcanceltoreassigndateAttribute($value)
    {
        $this->attributes['canceltoreassigndate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlaststagedateAttribute($value)
    {
        $this->attributes['laststagedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setupdatedbytimeAttribute($value)
    {
        $this->attributes['updatedbytime'] = $value ? (string) ModelHelper::convertClarionTime($value) : '';
    }
}
