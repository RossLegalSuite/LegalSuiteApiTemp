<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class feenote extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'FeeNote';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'documentid',
							'partyid',
							'feecodeid',
							'feeitemid',
							'unitid',
							'unitflag',
							'unittext',
							'unitquantity',
							'sorter',
							'matterid',
							'code2',
							'type1',
							'description',
							'overrideincomeaccflag',
							'date',
							'amount',
							'netamount',
							'vatrate',
							'vatie',
							'employeeid',
							'costcentreid',
							'period',
							'year',
							'agingperiod',
							'agingyear',
							'onhold',
							'postedflag',
							'addtocolldebitflag',
							'coldebitid',
							'documentcode',
							'combinedflag',
							'combinedquantity',
							'donotcombineflag',
							'voucher',
							'option1',
							'recordid',
							'postedbatchid',
							'posteddate',
							'source',
							'capturedperiod',
							'capturedyear',
							'amountincl',
							'vatamount',
							'postedby',
							'proformaheaderid'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setposteddateAttribute($value)
	{
		$this->attributes['posteddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
