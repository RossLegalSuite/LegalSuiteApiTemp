<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondcession extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BondCession';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'partyid',
							'bondcessiontypeid',
							'description',
							'insurancecompany',
							'policyno',
							'sasriano',
							'bank',
							'accountno',
							'amount',
							'conditions',
							'sorter',
							'noofshares',
							'sharevalue',
							'date',
							'companyname',
							'companyregno',
							'companydirectors',
							'certificatenumbers',
							'distinguishingnumbers',
							'lossofrent',
							'replacementvalue',
							'investmenttype',
							'investmentdepositissuedflag',
							'matpartyid',
							'insurancecompanyid',
							'insurancecompanymatpartyid',
							'sharepercentage',
							'sharesdematerialisedflag',
							'includeshareholdersclaimsflag'
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
        
