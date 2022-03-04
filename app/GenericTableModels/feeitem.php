<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class feeitem extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'FeeItem';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'feecodeid',
							'description',
							'amount',
							'sorter',
							'maximumamount',
							'unitsflag',
							'unitsid',
							'factor',
							'activityflag',
							'activityid',
							'vatrate',
							'vattypeflag',
							'fromdate',
							'todate',
							'fromamount',
							'toamount',
							'option1',
							'attorneyclientflag',
							'limitedby',
							'alwaysusethisdescriptionflag',
							'defended',
							'regionalcourtflag'
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
        
