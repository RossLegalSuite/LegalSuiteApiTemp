<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class matdef extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'MatDef';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'clientid',
        'docgenid',
        'mattertypeid',
        'documentlanguageid',
        'employeeid',
        'extrascreenid',
        'bankid',
        'filecabinet',
        'discount',
        'prescriptiondate',
        'casenumber',
        'access',
        'theirref',
        'contact',
        'salutation',
        'oldref',
        'internalcomment',
        'accountcomment',
        'clientfeesheetid',
        'accountslanguageid',
        'feeestimate',
        'feenotesonhold',
        'interestrate',
        'scheduleid',
        'agentflag',
        'adminfeeflag',
        'interestflag',
        'vatexemptflag',
        'discountsurcharge',
        'receiptoption',
        'consolidateid',
        'consolidatedflag',
        'invoiceflag',
        'invoiceoption',
        'invoiceformat',
        'costcentreid',
        'overrideincomeaccflag',
        'incomeaccid',
        'trustbankid',
        'movementflag',
        'collcommflag',
        'collcommoption',
        'collcommpercent',
        'collcommlimit',
        'todogroupid',
        'businessbankid',
        'branchflag',
        'branchid',
        'consolidatedisbursementsflag',
        'investmentfeeflag',
        'debtorfeesheetid',
        'debtorcollcommoption',
        'debtorcollcommpercent',
        'debtorcollcommlimit',
        'matgroup',
        'receiptpercenttocosts',
        'agreedfeepercent',
        'payattorneyfirstamount',
        'coldebitfeecodeid',
        'defaultbillingrateid',
        'stagegroupid',
        'casetype',
        'actingfor',
        'courtflag',
        'defended',
        'attorneyclientflag',
        'courtdate',
        'invoicebfwdoption',
        'invoicefeeoption',
        'invoicedisbursementoption',
        'receiptamount',
        'commentoption',
        'bondcauseid',
        'matteremployeeid',
        'internalcommentoption',
        'agreedfeelimit',
        'excludeunitsonaccountflag',
        'receiptpercent',
        'showprescriptionwarningflag',
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
