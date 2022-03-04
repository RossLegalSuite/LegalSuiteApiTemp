<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class matactiv extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'MatActiv';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'description',
        'matterid',
        'activityid',
        'sorter',
        'employeeid',
        'feeitemid',
        'feenoteid',
        'date',
        'minutes',
        'amount',
        'rateperhour',
        'billableflag',
        'billableamount',
        'recordid',
        'overrideamountflag',
        'unitsid',
        'billingrateid',
        'costcentreid',
        'disbursementid',
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
