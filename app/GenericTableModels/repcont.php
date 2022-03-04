<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class repcont extends Model
{

    protected $primaryKey = 'LanguageID';
    protected $table = 'RepCont';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'languageid',
							'business',
							'businessgroup',
							'businesstrialbalance',
							'businessincomeandexpenditure',
							'businessbalancesheet',
							'businesstransactions',
							'businessbudgets',
							'businesscashbook',
							'businessvatcontrol',
							'businessvatsummary',
							'businessvatprovision',
							'creditor',
							'creditorgroup',
							'creditordrageanalysis',
							'creditorcrageanalysis',
							'creditortransactions',
							'creditorbudgets',
							'creditortransfer',
							'creditoridlisting',
							'creditorremittance',
							'client',
							'clientincome',
							'clientbudgets',
							'clientmatters',
							'matter',
							'mattergroup',
							'matterdrageanalysis',
							'mattercrageanalysis',
							'matterinvestments',
							'matterinvestmenttransactions',
							'mattertransactions',
							'matterbudgets',
							'mattertransfer',
							'matteridlisting',
							'mattervatprovision',
							'matterinvoice',
							'costcentre',
							'costcentregroup',
							'costcentreincome',
							'costcentreincometransactions',
							'costcentrebudgets',
							'employee',
							'empoyeegroup',
							'employeeincome',
							'employeeincometransactions',
							'employeebudgets',
							'batches',
							'batchf',
							'batchd',
							'batchr',
							'batchp',
							'batchj',
							'batchi',
							'batchb',
							'batchc',
							'batche',
							'batcht',
							'batchs',
							'batchm',
							'batchx',
							'businessbankrecon',
							'billofcostsmag',
							'billofcostshigh',
							'costcentreexpense',
							'costcentreexpensetransactions',
							'employeeexpense',
							'employeeexpensetransactions',
							'trustanalysisid',
							'mattergroupid',
							'mattrangroupid',
							'businessgroupid',
							'bustrangroupid',
							'creditorgroupid',
							'cretrangroupid',
							'costcentregroupid',
							'costcentretrangroupid',
							'employeegroupid',
							'employeetrangroupid'
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
        
