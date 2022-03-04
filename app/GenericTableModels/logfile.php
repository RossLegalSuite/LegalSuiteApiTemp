<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class logfile extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'LogFile';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'date',
							'time',
							'employeeid',
							'xmltable',
							'xmlrecord',
							'xmlline',
							'xmlfield',
							'recordrecordid',
							'recordreference',
							'action',
							'error'
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
        
