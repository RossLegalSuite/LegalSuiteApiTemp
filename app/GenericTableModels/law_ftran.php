<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_ftran extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_FTran';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'transid',
        'number',
        'date',
        'd_c',
        'amount',
        'taxamount',
        'amount_description',
        'accountnumber',
        'tenantnumber',
        'interestpercentage',
        'interestfromdate',
        'accountname',
        'bankname',
        'branchcode',
        'receipt_number',
        'date_valid_from',
        'date_valid_to',
        'payee_name',
        'interest_rates_n',
        'tenant_name',
        'card_holder_name',
        'atm_card_number',
        'sect_fee_number',
        'debt_description',
        'switch_fin_y',
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
