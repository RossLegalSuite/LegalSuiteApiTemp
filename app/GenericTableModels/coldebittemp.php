<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class coldebittemp extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'ColDebitTemp';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'oldrecordid',
        'matterid',
        'colcostid',
        'employeeid',
        'date',
        'type',
        'description',
        'interestrate',
        'amount',
        'vatamount',
        'documentcode',
        'documentflag',
        'vatflag',
        'collcommflag',
        'category',
        'interestflag',
        'reference',
        'monthlyinterestflag',
        'balance',
        'costbalance',
        'interestbalance',
        'capitalbalance',
        'timerstamp',
        'batchid',
        'transid',
        'lineid',
        'exportedflag',
        'origin',
        'employersadminfeeflag',
        'overrideemocommflag',
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
