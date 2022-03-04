<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class feeitem extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'FeeItem';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'feecodeid',
        'description',
        'amount',
        'sorter',
        'maximumamount',
        'unitsflag',
        'unitsid',
        'factor',
        'activityflag',
        'activityid',
        'vatrate',
        'vattypeflag',
        'fromdate',
        'todate',
        'fromamount',
        'toamount',
        'option1',
        'attorneyclientflag',
        'limitedby',
        'alwaysusethisdescriptionflag',
        'defended',
        'regionalcourtflag',
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
