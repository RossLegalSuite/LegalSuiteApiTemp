<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class finyear extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'FinYear';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'year',
							'description',
							'grossprofit',
							'shortdesc',
							'period1enddate',
							'period2enddate',
							'period3enddate',
							'period4enddate',
							'period5enddate',
							'period6enddate',
							'period7enddate',
							'period8enddate',
							'period9enddate',
							'period10enddate',
							'period11enddate',
							'period12enddate',
							'auditedflag'
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
        
