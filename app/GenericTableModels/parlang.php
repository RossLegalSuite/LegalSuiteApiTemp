<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class parlang extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'ParLang';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'partyid',
							'languageid',
							'name',
							'firstname',
							'title',
							'identitynumber',
							'birthdate',
							'salutation',
							'physicalline1',
							'physicalline2',
							'physicalline3',
							'physicalcode',
							'postalline1',
							'postalline2',
							'postalline3',
							'postalcode',
							'spouseidentitynumber',
							'spousebirthdate',
							'maritaldescription',
							'domiciledin',
							'deedsregistry',
							'spousefirstname',
							'spousename',
							'marriagedate',
							'marriageplace',
							'marriagecountry',
							'ancnumber',
							'assistedflag',
							'spouseprincipalflag',
							'registrationnumber',
							'authorityphrase',
							'trustdate',
							'trustdivision',
							'defcitation',
							'placitation',
							'occupation',
							'employer',
							'capacityphrase',
							'docex',
							'gpaflag',
							'gpatype',
							'gpasignedat',
							'gpasignedby',
							'gpasignedon',
							'gpanumber',
							'initials',
							'alternativename',
							'spouseinitials',
							'spouseemailaddress',
							'spousemobile',
							'spouseidentitydocumenttype',
							'spousesignatoryid',
							'spousechecksum'
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
        
