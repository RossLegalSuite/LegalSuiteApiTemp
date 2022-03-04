<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class coldebitbackup extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ColDebitBackup';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
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
