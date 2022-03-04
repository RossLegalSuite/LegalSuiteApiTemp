<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class lawdeed_lodgingparalegal extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAWDeed_LodgingParaLegal';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'lawdeedid',
							'firstname',
							'lastname',
							'nonactive',
							'lodgingfirmlawdeedid',
							'lodgingbranchlawdeedid'
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
        
