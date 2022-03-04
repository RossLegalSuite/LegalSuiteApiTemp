<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class qbedetail extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'QBEDetail';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'qbeheaderid',
        'logicaloperator',
        'description',
        'tablename',
        'columnname',
        'columntype',
        'lookup1table',
        'lookup1column',
        'lookup1join',
        'lookup1type',
        'lookup2table',
        'lookup2column',
        'lookup2join',
        'lookup2type',
        'verb',
        'stringvalue',
        'numbervalue',
        'datevalue',
        'optiontype',
        'optionvalue',
        'additionalwhere',
        'additional1where',
        'additional2where',
        'additionaljoin',
        'additional1join',
        'additional2join',
        'droplistsql',
        'userdefinedwhere',
        'sorter',
        'timevalue',
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
