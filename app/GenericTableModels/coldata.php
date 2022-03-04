<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class coldata extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ColData';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'agentid',
        'principalflag',
        'principalid',
        'matterid',
        'recordid',
        'agentflag',
        'sheriffid',
        'particularsofclaimflag',
        'defendedflag',
        'particularsofclaimid',
        'actingfor',
        'defended',
        'aodaddress',
        'aoddebtorid',
        'aoddebtor',
        'aodamount',
        'aodcreditorid',
        'aodcreditor',
        'aoddate',
        'aodinstalments',
        'aodinterestrate',
        'attorneyfullnames',
        'amountofbid',
        'bankname',
        'banktown',
        'bankreason',
        'casetype',
        'causeofaction',
        'courtphonenumber',
        'courtfaxnumber',
        'ccjdebtnature',
        'ccjinterest',
        'emointerest',
        'wriinterest',
        'rewriinterest',
        'res65interest',
        'reemointerest',
        's65interest',
        's57interest',
        'ccjcoststotal',
        'emocoststotal',
        'judcoststotal',
        'wricoststotal',
        'rewricoststotal',
        'res65coststotal',
        'reemocoststotal',
        's65coststotal',
        's57coststotal',
        'ccjcostsvat',
        'emocostsvat',
        'judcostsvat',
        'wricostsvat',
        'rewricostsvat',
        'res65costsvat',
        'reemocostsvat',
        's65costsvat',
        's57costsvat',
        'ccjsubtotal',
        'emosubtotal',
        'wrisubtotal',
        'rewrisubtotal',
        'res65subtotal',
        'reemosubtotal',
        'rewriprevtotal',
        'res65prevtotal',
        'reemoprevtotal',
        'sumprevtotal',
        's65prevtotal',
        's65subtotal',
        's57subtotal',
        'emopaidsince',
        'ccjpaidsince',
        'rewripaidsince',
        'res65paidsince',
        'reemopaidsince',
        'wripaidsince',
        's65paidsince',
        's57paidsince',
        'emototal',
        'ccjtotal',
        'writotal',
        'rewritotal',
        'res65total',
        'reemototal',
        's65total',
        's57total',
        'ccjinterestflag',
        'emointerestflag',
        'emointerestrate',
        'ccjinterestrate',
        'emointerestto',
        'ccjinterestto',
        'ccjinterestfrom',
        'emointerestfrom',
        'chequedate',
        'courtboxnumber',
        'courtflag',
        'descriptionofgoods',
        'defaultsinsertedflag',
        'documentfooter',
        'emodebtorid',
        'emodebtor',
        'emoidnumber',
        'emocreditorid',
        'emocreditor',
        'emoemployername',
        'emoemployeraddress',
        'emodate',
        'emoamount',
        'emofirstdate',
        'emopaymentday',
        'emobalance',
        'furthercoststotal',
        'furthercostsvat',
        'highcourtaddress',
        'highcourtdivision',
        'highcourtofficial',
        'improve',
        'inextent',
        'judgmentcosts',
        'judgmentdate',
        'judgmentdebt',
        'judgmentplace',
        'jurisdictionclause',
        'loddatetorespond',
        'magcourtdistrict',
        'magcourtheldat',
        'magcourtofficial',
        'opensecurity',
        'particularsofclaim',
        'postaladdress',
        'propertydescription',
        'placesigned',
        'r41lastdate',
        'r41newdate',
        'r41newday',
        'r41newtime',
        'rdjdocuments',
        'rdjinterestfromdate',
        'rdjlesspaid',
        'rdjprayers',
        'rentpremises',
        'signatory',
        'suminterestrate',
        'sheriffaddress',
        'suminterestclause',
        'sumdaystorespond',
        'movsaledate',
        'immsaledate',
        'movsaletime',
        'immsaletime',
        'movsaleplace',
        'immsaleplace',
        'security',
        'surety',
        's57interestflag',
        's57interestfrom',
        's57interestrate',
        's57interestto',
        's57instalment',
        's57firstpaymentdate',
        's65court',
        's65date',
        's65firstpaymentdate',
        's65instalment',
        's65paymentsdueon',
        's65dayofweek',
        's65interestflag',
        's65interestfrom',
        's65interestrate',
        's65interestto',
        's65time',
        'transfernumber',
        'units',
        'wriinterestto',
        'rewriinterestto',
        'res65interestto',
        'reemointerestto',
        'wriinterestfrom',
        'rewriinterestfrom',
        'res65interestfrom',
        'reemointerestfrom',
        'wriinterestflag',
        'rewriinterestflag',
        'res65interestflag',
        'reemointerestflag',
        'wriinterestrate',
        'rewriinterestrate',
        'res65interestrate',
        'reemointerestrate',
        'writjurisdiction',
        'writproperty',
        'rdjoverrideflag',
        'lodoverrideflag',
        'sumoverrideflag',
        'judoverrideflag',
        'ccjoverrideflag',
        'emooverrideflag',
        's65overrideflag',
        's57overrideflag',
        'wrioverrideflag',
        'rewrioverrideflag',
        'res65overrideflag',
        'reemooverrideflag',
        'immoverrideflag',
        'movoverrideflag',
        'vatrate',
        'ccjdoneflag',
        'emodoneflag',
        'reemodoneflag',
        'immdoneflag',
        'juddoneflag',
        'loddoneflag',
        'movdoneflag',
        'rdjdoneflag',
        'r41doneflag',
        's57doneflag',
        's65doneflag',
        's65odoneflag',
        'res65doneflag',
        'sumdoneflag',
        'woadoneflag',
        'wridoneflag',
        'rewridoneflag',
        'sheriffareaid',
        'resumprevtotal',
        'resumcoststotal',
        'resumcostsvat',
        'resumsubtotal',
        'resumpaidsince',
        'resumtotal',
        'resumoverrideflag',
        'resumdoneflag',
        'billheading',
        'branchname',
        'employerid',
        'lookupemployerid',
        'attorneyclientflag',
        'excludelodcostsflag',
        'billcourt',
        'billscale',
        'billdistrict',
        'billallocaturflag',
        'billtaxedoffflag',
        'courtdate',
        'applicationdate',
        'administrator',
        'securityamount',
        'installmentamount',
        'frequency',
        'paymentdate',
        'furtherdate',
        'remaininginstallments',
        'lastinstallmentdate',
        'nextinstallmentdate',
        'popupreminder',
        'ptpstartdate',
        'employersadminfeeflag',
        'employersadminfeeamount',
        'newinduplumruleflag',
        'newinduplumrulefromdate',
        'magcourtaddress',
        'employeradminfeepercent',
        'attorneyadminfeeamount',
        'emoreturnofservicedate',
        'emoreturnofservicecomments',
        'reemoreturnofservicedate',
        'reemoreturnofservicecomments',
        'ptppaymentmethod',
        'reducecapitalflag',
        'induplumamount',
        'interestendamount',
        'emocommissionpercent',
        'overrideinduplumsetting',
        'induplumoption',
        'totaldue',
        'maxfees',
        'maxcommission',
        'intrateschedulevariance',
        's57collcomm',
        's57collcommflag',
        'emoenddate',
        'feesuntildate',
        'commissionuntildate',
        'courtdatereminderid',
        'receiptpercenttocostsflag',
        'lastpaymentdate',
        'lastpaymentamount',
        'nextpaymentdate',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setaoddateAttribute($value)
    {
        $this->attributes['aoddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemointeresttoAttribute($value)
    {
        $this->attributes['emointerestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setccjinteresttoAttribute($value)
    {
        $this->attributes['ccjinterestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setccjinterestfromAttribute($value)
    {
        $this->attributes['ccjinterestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemointerestfromAttribute($value)
    {
        $this->attributes['emointerestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setchequedateAttribute($value)
    {
        $this->attributes['chequedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemodateAttribute($value)
    {
        $this->attributes['emodate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemofirstdateAttribute($value)
    {
        $this->attributes['emofirstdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setjudgmentdateAttribute($value)
    {
        $this->attributes['judgmentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setloddatetorespondAttribute($value)
    {
        $this->attributes['loddatetorespond'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setr41lastdateAttribute($value)
    {
        $this->attributes['r41lastdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setr41newdateAttribute($value)
    {
        $this->attributes['r41newdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setrdjinterestfromdateAttribute($value)
    {
        $this->attributes['rdjinterestfromdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setmovsaledateAttribute($value)
    {
        $this->attributes['movsaledate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setimmsaledateAttribute($value)
    {
        $this->attributes['immsaledate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets57interestfromAttribute($value)
    {
        $this->attributes['s57interestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets57interesttoAttribute($value)
    {
        $this->attributes['s57interestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets57firstpaymentdateAttribute($value)
    {
        $this->attributes['s57firstpaymentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets65dateAttribute($value)
    {
        $this->attributes['s65date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets65firstpaymentdateAttribute($value)
    {
        $this->attributes['s65firstpaymentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets65interestfromAttribute($value)
    {
        $this->attributes['s65interestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function sets65interesttoAttribute($value)
    {
        $this->attributes['s65interestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setwriinteresttoAttribute($value)
    {
        $this->attributes['wriinterestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setrewriinteresttoAttribute($value)
    {
        $this->attributes['rewriinterestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setres65interesttoAttribute($value)
    {
        $this->attributes['res65interestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setreemointeresttoAttribute($value)
    {
        $this->attributes['reemointerestto'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setwriinterestfromAttribute($value)
    {
        $this->attributes['wriinterestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setrewriinterestfromAttribute($value)
    {
        $this->attributes['rewriinterestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setres65interestfromAttribute($value)
    {
        $this->attributes['res65interestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setreemointerestfromAttribute($value)
    {
        $this->attributes['reemointerestfrom'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcourtdateAttribute($value)
    {
        $this->attributes['courtdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setapplicationdateAttribute($value)
    {
        $this->attributes['applicationdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setpaymentdateAttribute($value)
    {
        $this->attributes['paymentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastinstallmentdateAttribute($value)
    {
        $this->attributes['lastinstallmentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setnextinstallmentdateAttribute($value)
    {
        $this->attributes['nextinstallmentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setptpstartdateAttribute($value)
    {
        $this->attributes['ptpstartdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setnewinduplumrulefromdateAttribute($value)
    {
        $this->attributes['newinduplumrulefromdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemoreturnofservicedateAttribute($value)
    {
        $this->attributes['emoreturnofservicedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setreemoreturnofservicedateAttribute($value)
    {
        $this->attributes['reemoreturnofservicedate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setemoenddateAttribute($value)
    {
        $this->attributes['emoenddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setfeesuntildateAttribute($value)
    {
        $this->attributes['feesuntildate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcommissionuntildateAttribute($value)
    {
        $this->attributes['commissionuntildate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastpaymentdateAttribute($value)
    {
        $this->attributes['lastpaymentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setnextpaymentdateAttribute($value)
    {
        $this->attributes['nextpaymentdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
