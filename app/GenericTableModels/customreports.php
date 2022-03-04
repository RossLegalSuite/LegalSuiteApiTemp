<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class customreports extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'CustomReports';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'basereportid',
							'userid',
							'name',
							'description',
							'jsonoptions',
							'datecreated',
							'deleted',
							'datedeleted',
							'deletedby',
							'membertype'
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
        
