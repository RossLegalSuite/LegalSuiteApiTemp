<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class ratetype extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'RateType';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'type',
							'date',
							'rate'
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
        
