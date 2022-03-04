<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class absainst extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'ABSAInst';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'accountno',
							'accounttb',
							'description',
							'languageid',
							'instructedtime',
							'instructeddate',
							'receiveddate',
							'lodgeddate',
							'upforfeesdate',
							'registereddate',
							'withdrawndate',
							'despatcheddate',
							'instructedflag',
							'receivedflag',
							'lodgedflag',
							'upforfeesflag',
							'registeredflag',
							'withdrawnflag',
							'despatchedflag',
							'payments',
							'paymentsflag',
							'ntustatus',
							'exportedon',
							'matterid',
							'source',
							'branchcode',
							'archiveflag',
							'date50',
							'date50flag',
							'date55',
							'date55flag',
							'date60',
							'date60flag',
							'date65',
							'date65flag',
							'date70',
							'date70flag',
							'date80',
							'date80flag',
							'institution',
							'account'
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
        
