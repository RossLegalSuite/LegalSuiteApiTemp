<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class mattran extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'MatTran';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'batchid',
        'reftype',
        'refid',
        'refdesc',
        'matterid',
        'transid',
        'lineid',
        'invoiceno',
        'date',
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
        'trustbankid',
        'investmentbankid',
        'period',
        'year',
        'employeeid',
        'costcentreid',
        'agingperiod',
        'agingyear',
        'consolidateid',
        'postingid',
        'recordid',
        'invoiceyear',
        'invoiceperiod',
        'invoicedate',
        'reversedflag',
        'buyerselleroption',
        'description',
        'matpartyid',
        'statusoption',
        'statusmemo',
        'proformaheaderid',
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
