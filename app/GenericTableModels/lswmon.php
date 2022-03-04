<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class lswmon extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'LswMon';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'uniquefield',
							'statusoption',
							'importdate',
							'importtime',
							'transno',
							'type',
							'date',
							'time',
							'username',
							'matter',
							'quantity',
							'sample',
							'description',
							'amount',
							'error',
							'coldebitid',
							'feenoteid',
							'linkfeenoteid',
							'naration',
							'filenoteid'
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
        
