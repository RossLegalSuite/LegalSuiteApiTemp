<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class secgroup extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'SecGroup';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'description',
							'businessoption',
							'matteroption',
							'creditoroption',
							'costcentreoption',
							'employeeoption',
							'clientoption',
							'reportoption',
							'spreadsheetoption',
							'matterfilerefflag',
							'matterarchivedflag',
							'financialalertsflag'
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
        
