<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class electronicchangelog extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'ElectronicChangeLog';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'source',
							'employeeid',
							'date',
							'time',
							'columnname',
							'columntype',
							'tablename',
							'tablerecordid',
							'matterid',
							'oldvalue',
							'newvalue',
							'rejectedflag'
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
        
