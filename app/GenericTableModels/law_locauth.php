<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_locauth extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_LocAuth';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'lawnumber',
							'description',
							'suiteid',
							'code',
							'testflag',
							'friendlyname',
							'rateslinkcompany',
							'deedsofficeid',
							'councilid',
							'active'
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
        
