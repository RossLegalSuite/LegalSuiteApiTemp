<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class empinactivealert extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'EmpInactiveAlert';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'employeeid',
							'filterinactivedays',
							'filterinactivedaystype',
							'filterinactivefilenotesflag',
							'filterfilenotesoption',
							'filterinactivefeenotesflag',
							'filterinactivetodonotesflag',
							'filterinactivecoldebitflag',
							'filterinactivemattranflag'
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
        
