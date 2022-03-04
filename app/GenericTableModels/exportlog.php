<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class exportlog extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ExportLog';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'exportfile',
        'destination',
        'employeeid',
        'date',
        'fromrecordid',
        'torecordid',
        'time',
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
