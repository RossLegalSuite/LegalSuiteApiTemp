<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class nedctl extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'NedCtl';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'receivepath',
							'diarypath',
							'clientid',
							'mattertypeid',
							'docgenid',
							'scheduleid',
							'clientfeesheetid',
							'inboxlocation',
							'outboxlocation',
							'todogroupid',
							'importverification',
							'donotaddpartiesflag',
							'donotupdatetrfpartiesflag'
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
        
