<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class filenote extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'FileNote';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'docfilenoteid',
        'date',
        'description',
        'employeeid',
        'stageid',
        'internalflag',
        'origin',
        'autonotifydate',
        'exportedflag',
        'doclogid',
        'time',
        'feenoteid',
        'createddate',
        'createdtime',
        'createdby',
        'todonoteid',
        'color',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function settimeAttribute($value)
    {
        $this->attributes['time'] = $value ? (string) ModelHelper::convertClarionTime($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreatedtimeAttribute($value)
    {
        $this->attributes['createdtime'] = $value ? (string) ModelHelper::convertClarionTime($value) : '';
    }

    public function setautonotifydateAttribute($value)
    {
        $this->attributes['autonotifydate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
