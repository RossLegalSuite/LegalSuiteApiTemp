<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_trans extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'LAW_Trans';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'matterid',
        'description',
        'date',
        'reason',
        'quantity',
        'total',
        'indicator',
        'senttolaw',
        'accountname',
        'bankname',
        'branchcode',
        'accountnumber',
        'creationdate',
        'date_extended_from',
        'date_extended_to',
        'official_name',
        'telephone_number',
        'fax_number',
        'branch_name',
        'readflag',
        'reference',
        'future_date',
        'sbsa_ins_y',
        'init_fee_paid',
        'law_messgid',
        'lawrefold',
        'bondpropid',
        'time',
        'employeeid',
        'recordid',
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
