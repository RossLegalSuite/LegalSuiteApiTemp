<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class rpt extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'rpt';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'description',
							'filename',
							'viewname',
							'filter',
							'sort',
							'customflag',
							'category',
							'sorter',
							'customisedflag',
							'clientoption',
							'matteroption',
							'businessoption',
							'creditoroption',
							'partyoption',
							'employeeoption',
							'costcentreoption',
							'mattertypeoption',
							'roleoption',
							'docgenoption',
							'groupoption',
							'periodoption',
							'asatperiodoption',
							'transactiondateoption',
							'instructeddateoption',
							'asatdateoption',
							'feesheetoption',
							'feecodeoption',
							'partytypeoption',
							'stageoption',
							'batchoption',
							'reconoption',
							'balanceamountoption',
							'transactionamountoption',
							'actualamountoption',
							'reservedamountoption',
							'investedamountoption',
							'batchedamountoption',
							'incomeamountoption',
							'expenseamountoption',
							'agingoption',
							'archiveoption',
							'invoiceoption',
							'descriptionoption',
							'sheriffareaoption',
							'customoption',
							'lookupcoldata',
							'lookupbonddata',
							'lookupclientparlang',
							'lookupmatterextrafields',
							'lookupclientextrafields',
							'processfeenotes',
							'processfilenotes',
							'processtodonotes',
							'processmattran',
							'processbillnote',
							'processcoldebit',
							'processmatparty',
							'processmatactiv',
							'docgencodeoption'
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
        
