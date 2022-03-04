<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondcausedetails extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BondCauseDetails';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'bondcauseid',
							'description',
							'englishwording',
							'afrikaanswording',
							'deedsofficefee',
							'tariffpercentage',
							'notransferdutyflag',
							'amountpercentage'
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
        
