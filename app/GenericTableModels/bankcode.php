<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bankcode extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'BankCode';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'banknumber',
        'centre',
        'description',
        'ibt',
        'suite',
        'acbcode',
        'acbdescription',
        'lawbankname',
        'universal',
        'debicheck',
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
