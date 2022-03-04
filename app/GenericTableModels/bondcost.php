<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bondcost extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'BondCost';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'our_postage',
        'age_postage',
        'bond_cents',
        'bond_units',
        'guar_cents',
        'guar_units',
        'guar_max',
        'sure_cents',
        'sure_units',
        'sure_max',
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
        'deed_canc',
        'canc_fee',
        'canc1_fee',
        'canc_fee_add',
        'canc_fee_pro',
        'canc_post',
        'age_c_fee',
        'age_c_fee_ad',
        'age_c_post',
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
        'age_canc_fee_add',
        'deedofficesearchfee',
        'ficafee',
        'fromdate',
        'todate',
        'live',
        'tariffdate',
        'canc_fee_sect',
        'canc1_fee_sect',
        'canc_fee_add_sect',
        'canc_fee_pro_sect',
        'canc_post_sect',
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
