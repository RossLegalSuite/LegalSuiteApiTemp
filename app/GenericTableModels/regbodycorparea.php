<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class regbodycorparea extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'RegBodyCorpArea';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'areanumber',
							'areadescription',
							'inextent',
							'heldby',
							'matterid',
							'sorter',
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
        
