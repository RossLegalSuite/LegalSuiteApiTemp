<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class matinv extends Model
{
    protected $primaryKey = ['BankId', 'MatterId'];

    protected $table = 'MatInv';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'matterid',
        'bankid',
        'date',
        'lastdate',
        'accountno',
        'invested',
        'withdrawals',
        'interest',
        'gpayments',
        'batched',
        'postingid',
        'batchid',
        'transid',
        'lineid',
        'investmentfeepercent',
        'investmentfeelimit',
        'accountname',
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
