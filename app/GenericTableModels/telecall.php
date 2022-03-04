<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class telecall extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'TeleCall';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'importid',
							'date',
							'time',
							'duration',
							'cost',
							'phonenumber',
							'extention',
							'trunk',
							'ringtime',
							'carrier',
							'calltype',
							'disbursement',
							'fee'
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
        
