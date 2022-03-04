<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class dgenlang extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DGenLang';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'docgenid',
							'languageid',
							'footerlocation',
							'headerlocation',
							'formalname',
							'shortname',
							'registrationnumber',
							'division',
							'extradebit1description',
							'extradebit1amount',
							'extradebit1vatflag',
							'extradebit2description',
							'extradebit2amount',
							'extradebit2vatflag'
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
        
