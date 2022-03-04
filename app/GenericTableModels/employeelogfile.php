<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class employeelogfile extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'EmployeeLogFile';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'date',
        'time',
        'description',
        'amount',
        'tablename',
        'action',
        'employeeid',
        'itemrecordid',
        'fileref',
        'processname',
        'source',
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
