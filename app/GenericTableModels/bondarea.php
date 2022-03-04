<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondarea extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BondArea';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'bondpropid',
							'sorter',
							'number',
							'description',
							'size',
							'heldby',
							'languageid',
							'recordid',
							'sectionplannumber',
							'units',
							'ratedflag',
							'subjectto',
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
        
