<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondabsa extends Model
{

    protected $primaryKey = 'MatterID';
    protected $table = 'BondAbsa';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'matterid',
							'institutionbranchlun',
							'customerbranchlun',
							'uniquereference',
							'customerreference',
							'customeruserlun',
							'institutionuserlun',
							'xmlversion',
							'vendorcode',
							'lawreference',
							'repaymenttype',
							'enrolmentcert',
							'enrolmentfee',
							'governmentsubsidyamount',
							'outsidehocproins',
							'governmentguarantee',
							'flexireserversign',
							'agentscommission',
							'comments',
							'marketinginformation',
							'deliverymethod',
							'firstname',
							'surname',
							'cellphonenumber',
							'hometelephonenumber',
							'worktelephonenumber',
							'emailaddress',
							'relationship',
							'retentionamount',
							'propertytype',
							'amountinsured',
							'rdvnc_a',
							'deliverytype',
							'esstatementindicator',
							'marketingviasms',
							'marketingviavoice',
							'marketingviaemail',
							'marketingviatelephone',
							'showotherpayementoption',
							'turnaroundtime',
							'turnaroundtimelastchecked',
							'stopcheckingturnaroundtime',
							'campaign',
							'campaignbenefitdescriptionone',
							'campaignbenefitdescriptiontwo',
							'campaignbenefitdescriptionthree',
							'campaignbenefitdescriptionfour',
							'campaignbenefitdescriptionfive',
							'campaignbenefitvalue',
							'campaignbenefitvalueperc'
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
        
