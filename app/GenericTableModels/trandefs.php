<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class trandefs extends Model
{

    protected $primaryKey = ['EmployeeID','LanguageID'];
    protected $table = 'TranDefs';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'employeeid',
							'languageid',
							'registrar',
							'pagrantedat',
							'appearer',
							'documentssignedat',
							'conveyancerfirstnames',
							'agent',
							'commissioner',
							'notary',
							'conveyancerinitials',
							'conveyancerlastname',
							'extendingclause',
							'heldbyconventional',
							'heldbysectional',
							'localauthority',
							'agentflag',
							'improvementsconventional',
							'improvementssectional',
							'province',
							'buildingname',
							'commissionpercent',
							'appearerpoa',
							'appearerdeed',
							'commissionerdesignation',
							'discountoption',
							'discountdisplayflag',
							'receiverid',
							'localauthorityid',
							'waterauthorityid',
							'lodgingagentid',
							'units',
							'proformaheading',
							'finalheading',
							'situatedat',
							'deedsofficeid',
							'letterhead',
							'addressinletterheadflag',
							'lodgingagentparalegalid',
							'bankdetailsonaccountflag',
							'conveyancerpracticeno'
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
        
