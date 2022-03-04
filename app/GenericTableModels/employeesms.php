<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class employeesms extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'EmployeeSms';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'employeeid',
							'boxoption',
							'date',
							'time',
							'processeddate',
							'processedtime',
							'status',
							'smsid',
							'fromnumber',
							'tonumber',
							'message',
							'partyid',
							'matterid',
							'parentsmsid',
							'newsmsflag'
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
        
