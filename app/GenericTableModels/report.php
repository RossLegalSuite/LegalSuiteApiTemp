<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class report extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'Report';
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
							'category',
							'sorter',
							'customisedflag',
							'comments',
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
							'languageoption',
							'customoption',
							'lookupcoldata',
							'lookupbonddata',
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
							'zerobalanceoption',
							'defaultgroupoption',
							'processbustran',
							'processcretran',
							'transactionfilter',
							'transactionsort',
							'postingoption',
							'branchoption',
							'systemreport',
							'sensitivity',
							'invoicelines',
							'normalflag',
							'reservedflag',
							'investedflag',
							'transferflag',
							'preprintedflag',
							'notransactionsflag',
							'remitoption',
							'invoicedateoption',
							'remitdateoption',
							'customdatedescription',
							'customdatefield',
							'customdateoption',
							'lookupparlang',
							'lookupparlang1',
							'lookupparlang2',
							'group1option',
							'group2option',
							'group3option',
							'spreadsheetflag',
							'orientation',
							'sectionbreak1',
							'sectionbreak2',
							'printbodyflag',
							'printfooter1flag',
							'formfeed1flag',
							'printfooter2flag',
							'formfeed2flag',
							'printgrandtotalsflag',
							'filterlocal',
							'excludebfwdflag',
							'lookupaccbank',
							'assetregoption',
							'businessfilter',
							'distributionoption',
							'processdistribution',
							'crosstabflag',
							'crosstabrow',
							'crosstabcol',
							'crosstabcell',
							'feenoteoption',
							'filenoteoption',
							'todonoteoption',
							'doclogoption',
							'coldebitoption',
							'voucheroption',
							'nextinstallmentdateoption',
							'lastinstallmentdateoption',
							'outstandingamountoption',
							'departmentoption',
							'todogroupoption',
							'stagegroupoption',
							'distributiongroupoption',
							'vatoption',
							'grandtotalfooter',
							'emailoption',
							'transactioncostcentreoption',
							'matactivoption',
							'printheadingsoneachpageflag',
							'sectionbreak1extra',
							'sectionbreak2extra',
							'creditortypeoption',
							'transactionemployeeoption',
							'lookuproleid',
							'partygroupoption',
							'distributionzerobalanceoption'
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
        