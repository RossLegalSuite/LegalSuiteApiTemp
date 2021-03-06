<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class docfoxtokenrequest extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DocFoxTokenRequest';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'employeeid',
							'partyid',
							'date',
							'time',
							'docfoxtokenid',
							'requestjson',
							'responsejson',
							'revoked',
							'expiresdate',
							'expirestime'
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
        
