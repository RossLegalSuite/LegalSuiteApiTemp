<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class docfoxdocumentupload extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DocFoxDocumentUpload';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'employeeid',
							'partyid',
							'date',
							'time',
							'docfoxid',
							'doclogid',
							'filename',
							'requestjson',
							'response',
							'docfoxdocumentid'
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
        
