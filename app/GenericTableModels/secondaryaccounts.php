<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class secondaryaccounts extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'SecondaryAccounts';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'debitorderid',
        'order',
        'type',
        'accountno',
        'quoteno',
        'corporatecode',
        'registerbond',
        'bondsequence',
        'loanamountavailable',
        'loanamount',
        'coverclauseamount',
        'loantermyears',
        'loantermmonths',
        'interestrate',
        'interestratefbt_fbc',
        'initiationfee',
        'monthlyadminfee',
        'secondaryaccountfee',
        'monthlyrepayment',
        'annualinsurancepremium',
        'valuationfee',
        'totalbondrepayment',
        'vatpercentage',
        'totalloanamount',
        'principaldebt',
        'installments',
        'installmentfrequency',
        'assuredamount',
        'annualpremium',
        'newloanrepayment',
        'employeeno',
        'eskomsbuno',
        'fixedrateterm',
        'annualpropertyinsurance',
        'affordablehousingindicator',
        'bondregistrationfees',
        'initiationfeecash',
        'feeamount',
        'totalfeesinterestinsurance',
        'totalfeesinterest',
        'propertyinsurername',
        'creditlifeinsurance',
        'totalloaninterest',
        'employeeclausecode',
        'primerate',
        'variance',
        'ahpepremiumfirstparticipant',
        'ahpepremiumsecondparticipant',
        'ahpecombinedcommission',
        'ahpecombinedcommissionhoc',
        'indemnitybondindicator',
        'costofcredit',
        'creditinsurance',
        'servicefeeaggregated',
        'creditlifeaggregated',
        'propertyinsuranceaggregated',
        'creditcostmultiple',
        'creditorname',
        'creditorcontactdetails',
        'creditoremailaddress',
        'creditoragent',
        'ultimatecreditorname',
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
