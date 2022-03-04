<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class debitorder extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DebitOrder';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'sorter',
							'accounttype',
							'accountnumber',
							'accountname',
							'branchcode',
							'bankcodeid',
							'bank',
							'branchname',
							'amount',
							'firstdate',
							'cycleday',
							'fixedamount',
							'frequency',
							'paymenton',
							'creaccountnumber',
							'creaccountname',
							'creaccounttype',
							'crebranchcode',
							'absarepaymenttype',
							'absaenrolmentcert',
							'absaoutsidehocproins',
							'absagovernmentguarantee',
							'absaflexireserversign',
							'absaagentscommission',
							'absacomments',
							'absaenrolmentfee',
							'absagovernmentsubsidyamount',
							'secondarybondid',
							'debitorderactiondayflag',
							'std_debit_order_amount',
							'partyid',
							'debicheckaccountindicator',
							'maximumcollectionamount',
							'instalmentamount',
							'contractreferencenumber',
							'creditorabbreviatedshortname',
							'creditorname',
							'trackingindicator',
							'dateadjustmentrule',
							'adjustmentcategory',
							'debitvaluetype',
							'nomineepartyid',
							'status',
							'absareason',
							'ultimatedebtorpartyid',
							'overrideaccountname',
							'universalbranchesflag',
							'islocked',
							'mandate',
							'bisonmandate',
							'originalamount'
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
        
