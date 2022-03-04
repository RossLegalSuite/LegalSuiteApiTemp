<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class creditor extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Creditor';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'trustbankid',
        'description',
        'contact',
        'phoneno',
        'docex',
        'postalline1',
        'postalline2',
        'postalline3',
        'postalcity',
        'postalcode',
        'remitoption',
        'nextremitno',
        'nextremittransactions',
        'lastremitno',
        'lastremitdate',
        'lastremitactual',
        'actual',
        'agecurrent',
        'age30day',
        'age60day',
        'age90day',
        'age120day',
        'age150day',
        'age180day',
        'transfer',
        'batched',
        'postingid',
        'batchid',
        'transid',
        'lineid',
        'oldcode',
        'notusedflag',
        'vatprovision',
        'totaldrtrust',
        'totalcrtrust',
        'totaldrbusiness',
        'totalcrbusiness',
        'totaltransfered',
        'theirref',
        'businessid',
        'commentoption',
        'comment',
        'groupid',
        'accbankid',
        'vatvendorflag',
        'vatnumber',
        'type',
        'beerating',
        'legalsuitefirmcode',
        'faxno',
        'email',
        'cellphone',
        'businessbankid',
        'entity',
        'editcomment',
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
