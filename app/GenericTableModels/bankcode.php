<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bankcode extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'BankCode';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'banknumber',
							'centre',
							'description',
							'ibt',
							'suite',
							'acbcode',
							'acbdescription',
							'lawbankname',
							'universal',
							'debicheck'
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
        
