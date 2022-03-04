<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bondsecondary extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'BondSecondary';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'accountno',
        'quoteno',
        'loanamount',
        'loantermyears',
        'loantermmonths',
        'interestrate',
        'interestratefbt_fbc',
        'initiationfee',
        'monthlyrepayment',
        'annualinsurancepremium',
        'valuationfee',
        'installments',
        'installmentfrequency',
        'fixedrateterm',
        'initiationfeecash',
        'totalfeesinterest',
        'totalloaninterest',
        'primerate',
        'variance',
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
