<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class regextsect extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'RegExtSect';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'sectionnumber',
							'inextent',
							'heldby',
							'sorter',
							'linkedmatterid',
							'conditionclauseid',
							'conditionclauseflag'
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
        
