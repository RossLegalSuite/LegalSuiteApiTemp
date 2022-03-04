<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondcause extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BondCause';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
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
        
