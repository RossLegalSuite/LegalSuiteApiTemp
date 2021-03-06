<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class guaranteehubrequestsreceived extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'GuaranteeHubRequestsReceived';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'requestidentifier',
							'filereference',
							'bondreference',
							'bondattorneyname',
							'requestorname',
							'requestorattorneyrole',
							'subject',
							'parties',
							'property',
							'sharedguarantees',
							'date',
							'time'
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
        
