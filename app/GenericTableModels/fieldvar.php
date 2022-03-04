<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class fieldvar extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'FieldVar';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'fieldid',
        'variableid',
        'sorter',
        'format',
        'customformat',
        'converttowordsflag',
        'precharacter',
        'postcharacter',
        'variableseparator',
        'overrideseparatorflag',
        'truecondition',
        'falsecondition',
        'wordscase',
        'tabbeforeflag',
        'tabafterflag',
        'fieldafterid',
        'fieldafterflag',
        'fieldbeforeflag',
        'fieldbeforeid',
        'specificpartyid',
        'specificpartyflag',
        'pronounflag',
        'pronounrecordid',
        'pronounpartyid',
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
