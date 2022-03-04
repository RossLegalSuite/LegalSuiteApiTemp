<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class coldebitbackup extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'ColDebitBackup';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'colcostid',
							'employeeid',
							'date',
							'type',
							'description',
							'interestrate',
							'amount',
							'vatamount',
							'documentcode',
							'documentflag',
							'vatflag',
							'collcommflag',
							'category',
							'interestflag',
							'reference',
							'monthlyinterestflag',
							'balance',
							'costbalance',
							'interestbalance',
							'capitalbalance',
							'timerstamp',
							'batchid',
							'transid',
							'lineid',
							'exportedflag',
							'origin',
							'employersadminfeeflag',
							'overrideemocommflag'
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
        
