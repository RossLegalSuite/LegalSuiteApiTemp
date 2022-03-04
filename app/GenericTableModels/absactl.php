<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class absactl extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'ABSACtl';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'regibondpath',
							'regibondcommand',
							'clientid',
							'mattertypeid',
							'docgenid',
							'scheduleid',
							'clientfeesheetid',
							'afrikaansid',
							'englishid',
							'rtflocation',
							'licencenumber',
							'virginclientid',
							'sanlamclientid',
							'attorneycode'
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
        
