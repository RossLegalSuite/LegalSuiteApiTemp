<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class task extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Task';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'eventid',
							'type',
							'otherid',
							'description',
							'truecondition',
							'sqlscript',
							'sorter',
							'delaydays',
							'delaytruecondition',
							'delaytype',
							'delayuntil',
							'englishdescription',
							'afrikaansdescription',
							'amount'
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
        
