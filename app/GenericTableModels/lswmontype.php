<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class lswmontype extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'LswMonType';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'description',
							'businessid',
							'type',
							'feeoption',
							'feeamount',
							'englishdesc',
							'afrikaansdesc',
							'feeenglishdesc',
							'feeafrikaansdesc',
							'filenoteenglishdesc',
							'filenoteafrikaansdesc'
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
        
