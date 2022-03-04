<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bustran extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BusTran';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'batchid',
							'transid',
							'lineid',
							'businessid',
							'description',
							'date',
							'amount',
							'vouchertype',
							'voucher',
							'bankreconno',
							'booktype',
							'bustrust',
							'trantype',
							'trantype1',
							'bankstatement',
							'period',
							'year',
							'reftype',
							'refid',
							'refdesc',
							'vattype',
							'vatrate',
							'vatpercent',
							'vaton',
							'employeeid',
							'costcentreid',
							'comments',
							'postingid',
							'recordid',
							'reversedflag',
							'reconflag',
							'assetregid',
							'subreconflag',
							'bankrecondate',
							'bankreconbooktype'
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
        
