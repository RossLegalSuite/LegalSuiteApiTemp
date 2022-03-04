<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bustranrecon extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BusTranRecon';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'businessid',
							'year',
							'period',
							'bankrecondate',
							'bankreconno',
							'trantype',
							'amount',
							'bankstatement',
							'reconflag',
							'voucher',
							'vouchertype',
							'description',
							'batchid',
							'transid',
							'lineid',
							'refdesc'
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
        
