<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class customreports extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'CustomReports';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'basereportid',
        'userid',
        'name',
        'description',
        'jsonoptions',
        'datecreated',
        'deleted',
        'datedeleted',
        'deletedby',
        'membertype',
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
