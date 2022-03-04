<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class deadmattran extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'DeadMatTran';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'deadmatterid',
        'date',
        'description',
        'batchid',
        'transid',
        'lineid',
        'postingid',
        'refdesc',
        'amount',
        'vatrate',
        'vatpercent',
        'vattype',
        'vouchertype',
        'voucher',
        'bankreconno',
        'booktype',
        'bustrust',
        'trantype',
        'trantype1',
        'reversedflag',
        'period',
        'year',
        'invoiceno',
        'investmentbankid',
        'employeeid',
        'costcentreid',
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
