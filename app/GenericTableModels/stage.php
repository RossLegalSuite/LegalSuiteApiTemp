<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class stage extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Stage';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'description',
							'code',
							'stagegroupid',
							'amount',
							'makefeenoteflag',
							'reportheading',
							'lawmessageno',
							'autonotifyflag',
							'autonotifymessage',
							'inactiveflag',
							'sorter',
							'largeiconfilename',
							'smalliconfilename',
							'conditionoption',
							'condition',
							'datechangeflag',
							'filenotecolor'
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
        
