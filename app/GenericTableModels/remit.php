<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class remit extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'Remit';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'creditorid',
        'type',
        'date',
        'transactions',
        'lastremitactual',
        'thisremitactual',
        'actual',
        'agecurrent',
        'age30day',
        'age60day',
        'age90day',
        'age120day',
        'age150day',
        'age180day',
        'printedflag',
        'remitno',
        'lastremitno',
        'lastremitdate',
        'period',
        'year',
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
