<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class coldebit extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'ColDebit';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
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
        'recordid',
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
