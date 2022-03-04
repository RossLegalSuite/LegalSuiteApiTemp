<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondcanc extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'BondCanc';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'sorter',
							'signatories',
							'authorityphrase',
							'mortgagors',
							'bondnumber',
							'bondamount',
							'additionalamount',
							'noofproperties',
							'mortgagorline',
							'shortprop',
							'consentcedents',
							'consentcessionnumber',
							'consentcessiondate',
							'consenttype',
							'accountnumber',
							'propertydescription',
							'titledeed',
							'additionalinstructions',
							'outstandingbalance',
							'insurance',
							'assurance',
							'servicefee',
							'earlyterminationfee',
							'debitorder',
							'legalfee',
							'fixedratepenaltyinterest',
							'amountrequired',
							'type',
							'plusminus',
							'rate',
							'amount',
							'startdate',
							'rank',
							'acbcode',
							'branchname',
							'branchcode',
							'type1',
							'plusminus1',
							'rate1',
							'amount1',
							'startdate1',
							'type2',
							'plusminus2',
							'rate2',
							'amount2',
							'startdate2',
							'type3',
							'plusminus3',
							'rate3',
							'amount3',
							'startdate3',
							'type4',
							'plusminus4',
							'rate4',
							'amount4',
							'startdate4',
							'bankname',
							'bankcontactname',
							'bankemail',
							'bankphonenumber',
							'bankfaxnumber',
							'bankaddress',
							'bankpostaladdress',
							'bankdocsreturnaddress',
							'bankbranch',
							'bankdivisioncode',
							'bankbrandcode',
							'bankdocumentset'
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
        
