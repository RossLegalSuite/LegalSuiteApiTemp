<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class cretran extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'CreTran';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'batchid',
							'reftype',
							'refid',
							'refdesc',
							'transid',
							'lineid',
							'creditorid',
							'year',
							'period',
							'date',
							'remitno',
							'description',
							'amount',
							'vatpercent',
							'vatrate',
							'vattype',
							'vouchertype',
							'voucher',
							'bankreconno',
							'booktype',
							'bustrust',
							'trantype',
							'trantype1',
							'employeeid',
							'costcentreid',
							'postingid',
							'recordid',
							'reversedflag',
							'statusoption'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
