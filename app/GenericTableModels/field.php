<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class field extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Field';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'name',
        'description',
        'variableseparator',
        'recursefileflag',
        'currentmatterflag',
        'fileid',
        'roleid',
        'filterexpression',
        'orderexpression',
        'recordseparator',
        'operation',
        'freezeflag',
        'recurseareasflag',
        'category',
        'recursefilecounter',
        'customrecordseparator',
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
