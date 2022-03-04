<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class battran extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BatTran';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'batchid',
							'transid',
							'type1',
							'type2',
							'code1',
							'code2',
							'code3',
							'description1',
							'description2',
							'description3',
							'option1',
							'option2',
							'option3',
							'option4',
							'ledgertype1',
							'ledgertype2',
							'date',
							'amount',
							'amountadditional',
							'vatie',
							'vatrate',
							'vattype',
							'vatpercent',
							'employeeid',
							'costcentreid',
							'voucherflag',
							'vouchertype',
							'voucher',
							'bankreconno',
							'collcommflag',
							'agentflag',
							'adminfeeflag',
							'printedflag',
							'postedflag',
							'screenid',
							'source',
							'period',
							'year',
							'agingperiod',
							'agingyear',
							'comments',
							'deletedflag',
							'deletedbyid',
							'collcommpercent',
							'collcommlimit',
							'booktype',
							'addtocolldebitflag',
							'recordid',
							'conversionflag',
							'parbankid',
							'buyerselleroption',
							'agreedfeeflag',
							'addfilenoteflag',
							'matpartyid',
							'reserved',
							'vatlastpostingid',
							'debtorcollcommflag',
							'feenoteid',
							'importid',
							'recondate',
							'alreadyinvoicedflag',
							'proformaheaderid'
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
        
