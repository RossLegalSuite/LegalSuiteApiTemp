<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bankrec extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BankRec';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'bankid',
							'bankreconno',
							'vouchertype',
							'voucher',
							'year',
							'period',
							'date',
							'trantype',
							'employeeid',
							'amount',
							'statement',
							'batchid',
							'transid',
							'lineid',
							'description',
							'statusflag',
							'reftype',
							'refid',
							'refdesc',
							'bankstatement',
							'reconciledamount',
							'notes',
							'recordid'
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
        
