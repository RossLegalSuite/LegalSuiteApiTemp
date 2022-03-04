<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class ph_mattermessage extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'PH_MatterMessage';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'propertyhubid',
							'transactiontype',
							'date',
							'time',
							'readflag',
							'messageid',
							'details',
							'ph_messagesreceivedid',
							'employeeid',
							'actiondate'
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
        
