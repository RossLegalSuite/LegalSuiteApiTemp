<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class trancost extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'TranCost';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'rat_clear',
        'levy_clear',
        'our_postage',
        'comm_perc',
        'age_postage',
        'tariff_yes',
        'imp_perc1',
        'imp_break1',
        'imp_break2',
        'imp_perc2',
        'imp_perc3',
        'imp_free',
        'un_perc1',
        'un_break1',
        'un_break2',
        'un_perc2',
        'un_perc3',
        'un_free',
        'jur_perc',
        'c_props',
        's_props',
        'reg_upto1',
        'reg_fee1',
        'reg_upto2',
        'reg_fee2',
        'reg_upto3',
        'reg_fee3',
        'reg_upto4',
        'reg_fee4',
        'reg_upto5',
        'reg_fee5',
        'reg_area',
        'feeexclusefi1',
        'feeexclusefi2',
        'feeexclusead1',
        'feeexclusead2',
        'reg_upto6',
        'reg_upto7',
        'reg_upto8',
        'reg_upto9',
        'reg_upto10',
        'reg_fee6',
        'reg_fee7',
        'reg_fee8',
        'reg_fee9',
        'reg_fee10',
        'deedsofficecessionfee',
        'deedofficesearchfee',
        'ficafee',
        'fromdate',
        'todate',
        'imp_basic3',
        'imp_amount2',
        'imp_amount3',
        'imp_amount4',
        'imp_break3',
        'imp_perc4',
        'imp_break4',
        'imp_perc5',
        'imp_amount5',
        'imp_break5',
        'imp_perc6',
        'live',
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
