<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class docdebit extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'Docdebit';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'documentid',
							'feecodeid',
							'recordid',
							'truecondition',
							'duplicatefeenoteoption',
							'proformaflag',
							'sorter',
							'descriptionmethod',
							'customenglishwording',
							'customafrikaanswording'
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
        
