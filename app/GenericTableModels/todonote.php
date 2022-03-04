<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class todonote extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'ToDoNote';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'matterid',
							'employeeid',
							'date',
							'description',
							'nextdocumentid',
							'datedone',
							'recordid',
							'todoitemid',
							'autonotifydate',
							'completedbyid',
							'completedflag',
							'completedbynotes',
							'partyid',
							'createdbyid',
							'createddate',
							'createdtime',
							'completedtime',
							'dateadjustment',
							'outlooktaskid',
							'outlookappointmentid',
							'appttime',
							'recurringflag',
							'recurringperiod',
							'recurringcustomtype',
							'recurringcustomamount',
							'priority'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreatedtimeAttribute($value)
	{
		$this->attributes['createdtime'] = $value ? (String)ModelHelper::convertClarionTime($value) : '';
	}



	public function setdatedoneAttribute($value)
	{
		$this->attributes['datedone'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcompletedtimeAttribute($value)
	{
		$this->attributes['completedtime'] = $value ? (String)ModelHelper::convertClarionTime($value) : '';
	}


	public function setautonotifydateAttribute($value)
	{
		$this->attributes['autonotifydate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setdateadjustmentAttribute($value)
	{
		$this->attributes['dateadjustment'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
