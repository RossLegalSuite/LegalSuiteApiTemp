<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class lgltrax extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LglTrax';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'documentid',
							'partyid',
							'feecodeid',
							'feeitemid',
							'unitid',
							'unitflag',
							'unittext',
							'unitquantity',
							'matterid',
							'code2',
							'type1',
							'description',
							'overrideincomeaccflag',
							'date',
							'time',
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
							'errorflag'
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
        
