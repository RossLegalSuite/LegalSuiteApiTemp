<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class doclog extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'DocLog';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'matterid',
							'employeeid',
							'description',
							'date',
							'savedname',
							'time',
							'noofpages',
							'noofwords',
							'documentid',
							'partyid',
							'printonlyflag',
							'emailflag',
							'emailfolder',
							'emailreceivedtime',
							'emailfrom',
							'emailbody',
							'emailcc',
							'emailrecipients',
							'emailsentdate',
							'emailimportedflag',
							'recordid',
							'doclogcategoryid',
							'direction',
							'creditorid',
							'businessid',
							'url',
							'conversationid',
							'conversationindex',
							'signable',
							'doclogsubcategoryid'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function settimeAttribute($value)
	{
		$this->attributes['time'] = $value ? (String)ModelHelper::convertClarionTime($value) : '';
	}

	// public function setcreateddateAttribute($value)
	// {
	// 	$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	// }

	// public function setdatedoneAttribute($value)
	// {
	// 	$this->attributes['datedone'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	// }

	// public function setautonotifydateAttribute($value)
	// {
	// 	$this->attributes['autonotifydate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	// }

	// public function setdateadjustmentAttribute($value)
	// {
	// 	$this->attributes['dateadjustment'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	// }

}
        
