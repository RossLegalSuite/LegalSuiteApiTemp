<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class parfield extends Model
{
    protected $primaryKey = ['DocScreenID', 'PartyID'];

    protected $table = 'ParField';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'partyid',
        'field1',
        'field2',
        'field3',
        'field4',
        'field5',
        'field6',
        'field7',
        'field8',
        'field9',
        'field10',
        'field11',
        'field12',
        'field13',
        'field14',
        'field15',
        'field16',
        'field17',
        'field18',
        'field19',
        'field20',
        'field21',
        'field22',
        'field23',
        'field24',
        'field25',
        'field26',
        'field27',
        'field28',
        'field29',
        'field30',
        'docscreenid',
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
