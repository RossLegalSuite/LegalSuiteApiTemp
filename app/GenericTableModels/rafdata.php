<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class rafdata extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'RafData';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'accidenttime',
        'accidentdate',
        'accidentplace',
        'deathflag',
        'deathdate',
        'deathplace',
        'inquestflag',
        'inquestcourt',
        'inquestdate',
        'inquestreference',
        'deathworkflag',
        'deathcompensationflag',
        'compensationamount',
        'compensationreference',
        'place',
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
