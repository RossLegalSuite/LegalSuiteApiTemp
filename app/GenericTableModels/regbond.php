<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class regbond extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'RegBond';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'bondholder',
        'bondholderregno',
        'bondnumber',
        'bondamount',
        'additionalamount',
        'signatories',
        'authorityphrase',
        'cededto',
        'cessionaryregno',
        'cessiondate',
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
