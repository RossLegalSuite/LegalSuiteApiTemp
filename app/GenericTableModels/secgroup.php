<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class secgroup extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'SecGroup';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'description',
        'businessoption',
        'matteroption',
        'creditoroption',
        'costcentreoption',
        'employeeoption',
        'clientoption',
        'reportoption',
        'spreadsheetoption',
        'matterfilerefflag',
        'matterarchivedflag',
        'financialalertsflag',
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
