<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class parsign extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'ParSign';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'partyid',
							'sorter',
							'firstname',
							'lastname',
							'birthdate',
							'identitynumber',
							'maritalstatus',
							'spousename',
							'spouseidentitynumber',
							'assistedflag',
							'position',
							'nonsignatoryflag',
							'entityid',
							'recordid',
							'bankparticipantid',
							'signatoryid',
							'checksum',
							'identitydocumenttype',
							'emailaddress',
							'mobilenumber',
							'businessunit',
							'title',
							'actualpartyid'
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
        
