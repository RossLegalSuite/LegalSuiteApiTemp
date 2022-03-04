<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class filenote extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'FileNote';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'docfilenoteid',
							'date',
							'description',
							'employeeid',
							'stageid',
							'internalflag',
							'origin',
							'autonotifydate',
							'exportedflag',
							'doclogid',
							'time',
							'feenoteid',
							'createddate',
							'createdtime',
							'createdby',
							'todonoteid',
							'color'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function settimeAttribute($value)
	{
		$this->attributes['time'] = $value ? (String)ModelHelper::convertClarionTime($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreatedtimeAttribute($value)
	{
		$this->attributes['createdtime'] = $value ? (String)ModelHelper::convertClarionTime($value) : '';
	}

	public function setautonotifydateAttribute($value)
	{
		$this->attributes['autonotifydate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
