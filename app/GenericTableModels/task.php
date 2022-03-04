<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Task';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'eventid',
        'type',
        'otherid',
        'description',
        'truecondition',
        'sqlscript',
        'sorter',
        'delaydays',
        'delaytruecondition',
        'delaytype',
        'delayuntil',
        'englishdescription',
        'afrikaansdescription',
        'amount',
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
