<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class business extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'Business';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'type',
        'description',
        'typeextension',
        'defaultvatrate',
        'accountno',
        'branchcode',
        'lastreceipt',
        'lastcheque',
        'lastdepositno',
        'printchequeflag',
        'chequeprinter',
        'commentsxpos',
        'commentsypos',
        'payeexpos',
        'payeeypos',
        'datexpos',
        'dateypos',
        'amountwordsxpos',
        'amountwordsypos',
        'amountwordswidth',
        'amountwordsheight',
        'amountxpos',
        'amountypos',
        'reconciled',
        'transfer',
        'balancebfwd',
        'lperiod1',
        'lperiod2',
        'lperiod3',
        'lperiod4',
        'lperiod5',
        'lperiod6',
        'lperiod7',
        'lperiod8',
        'lperiod9',
        'lperiod10',
        'lperiod11',
        'lperiod12',
        'period1',
        'period2',
        'period3',
        'period4',
        'period5',
        'period6',
        'period7',
        'period8',
        'period9',
        'period10',
        'period11',
        'period12',
        'budget1period1',
        'budget1period2',
        'budget1period3',
        'budget1period4',
        'budget1period5',
        'budget1period6',
        'budget1period7',
        'budget1period8',
        'budget1period9',
        'budget1period10',
        'budget1period11',
        'budget1period12',
        'budget2period1',
        'budget2period2',
        'budget2period3',
        'budget2period4',
        'budget2period5',
        'budget2period6',
        'budget2period7',
        'budget2period8',
        'budget2period9',
        'budget2period10',
        'budget2period11',
        'budget2period12',
        'budget3period1',
        'budget3period2',
        'budget3period3',
        'budget3period4',
        'budget3period5',
        'budget3period6',
        'budget3period7',
        'budget3period8',
        'budget3period9',
        'budget3period10',
        'budget3period11',
        'budget3period12',
        'postingid',
        'batchid',
        'transid',
        'lineid',
        'oldcode',
        'notusedflag',
        'lastbankstatement',
        'chequeprintcommand',
        'shortcode',
        'costcentreid',
        'employeeid',
        'commentoption',
        'comment',
        'recordid',
        'group1id',
        'group2id',
        'group3id',
        'accountname',
        'accbankid',
        'deppercent',
        'depbusinessid',
        'assetregflag',
        'linkid',
        'linkoption',
        'bankid',
        'invoiceenglishdesc',
        'invoiceafrikaansdesc',
        'lastreconyear',
        'lastreconperiod',
        'lastdirectpmt',
        'lastbankstatementamount',
        'branchid',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
