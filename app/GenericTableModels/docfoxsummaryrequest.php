<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class docfoxsummaryrequest extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DocFoxSummaryRequest';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'employeeid',
							'partyid',
							'date',
							'time',
							'docfoxsummaryid',
							'requestjson',
							'downloaded',
							'datedownloaded',
							'timedownloaded'
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
        
