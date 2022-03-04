<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class trademark extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Trademark';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'name',
							'description',
							'alternative1',
							'alternative2',
							'renewaldate',
							'applicationdate',
							'applicationnumber',
							'registrationdate',
							'registrationnumber',
							'countryid',
							'agentid',
							'tradetypeid',
							'classification',
							'wildcard',
							'poanumber',
							'wildcard1',
							'donotsearchflag',
							'imagefile',
							'metaphonename',
							'metaphone1',
							'metaphone2',
							'wildcard2',
							'wildcard3',
							'proprietor',
							'tradeclassid',
							'notes'
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
        
