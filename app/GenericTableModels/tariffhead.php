<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class tariffhead extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'TariffHead';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'type',
        'cplus',
        'splus',
        'lplus',
        'cper',
        'sper',
        'lper',
        'cover',
        'sover',
        'lover',
        'cplus1',
        'splus1',
        'lplus1',
        'cper1',
        'sper1',
        'lper1',
        'cover1',
        'sover1',
        'lover1',
        'cupto1',
        'supto1',
        'lupto1',
        'cthereafter2',
        'sthereafter2',
        'lthereafter2',
        'cper2',
        'sper2',
        'lper2',
        'cupto2',
        'supto2',
        'lupto2',
        'cthereafter3',
        'sthereafter3',
        'lthereafter3',
        'cper3',
        'sper3',
        'lper3',
        'cplus4',
        'splus4',
        'lplus4',
        'fromdate',
        'todate',
        'cupto',
        'cthereafter',
        'cthereafterper',
        'supto',
        'sthereafter',
        'sthereafterper',
        'cupto3',
        'cthereafter4',
        'cper4',
        'live',
        'cplus4maximum',
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
