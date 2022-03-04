<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class province extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'Province';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'description'
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
        