<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class costcentre extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'CostCentre';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'description',
        'incomeaccid',
        'incomeytd',
        'income1',
        'income2',
        'income3',
        'income4',
        'income5',
        'income6',
        'income7',
        'income8',
        'income9',
        'income10',
        'income11',
        'income12',
        'lincome1',
        'lincome2',
        'lincome3',
        'lincome4',
        'lincome5',
        'lincome6',
        'lincome7',
        'lincome8',
        'lincome9',
        'lincome10',
        'lincome11',
        'lincome12',
        'budget1',
        'budget2',
        'budget3',
        'budget4',
        'budget5',
        'budget6',
        'budget7',
        'budget8',
        'budget9',
        'budget10',
        'budget11',
        'budget12',
        'postingid',
        'batchid',
        'transid',
        'lineid',
        'oldcode',
        'notusedflag',
        'expenseytd',
        'expense1',
        'expense2',
        'expense3',
        'expense4',
        'expense5',
        'expense6',
        'expense7',
        'expense8',
        'expense9',
        'expense10',
        'expense11',
        'expense12',
        'lexpense1',
        'lexpense2',
        'lexpense3',
        'lexpense4',
        'lexpense5',
        'lexpense6',
        'lexpense7',
        'lexpense8',
        'lexpense9',
        'lexpense10',
        'lexpense11',
        'lexpense12',
        'groupid',
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
