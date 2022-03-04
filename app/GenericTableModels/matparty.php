<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class matparty extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'MatParty';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'matterid',
							'partyid',
							'reference',
							'roleid',
							'sorter',
							'ratesurityindicator',
							'rateprimaryapplicant',
							'rateperminantresident',
							'ratecustomerrole',
							'notification_method_x',
							'rateportion_share_p',
							'claimamount',
							'distributionpercent',
							'distributedamount',
							'claimdescription',
							'payablefrom',
							'instalmentamount',
							'instalmentfrequency',
							'district',
							'caseno',
							'courtorderdetails',
							'payableto',
							'balance',
							'attorneyid',
							'claimoption',
							'contactid',
							'matterdescription',
							'noflag',
							'nocapacity',
							'noprincipal',
							'recordid',
							'languageid',
							'paidoutbfwd',
							'suretyamount',
							'suretyunlimitedflag',
							'suretysecurity',
							'rateestatetype',
							'employmentstatus',
							'employername',
							'employeraddress',
							'employertele',
							'relativefullname',
							'relativeaddress',
							'relativetele',
							'contactrelationshipid',
							'partyrelationshipid',
							'compliancestatus',
							'maxclaimamount',
							'includeinlifeassurance',
							'effectivedate',
							'connectedparty',
							'sars_sharepercentage',
							'commissionpercent',
							'commissionamount',
							'commissionexcludesvatflag',
							'spouse_sars_sharepercentage',
							'customernumber',
							'bankparticipantid',
							'signatoryid',
							'requirementcodes',
							'participantnr'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function seteffectivedateAttribute($value)
	{
		$this->attributes['effectivedate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
