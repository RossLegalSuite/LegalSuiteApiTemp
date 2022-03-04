<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class docscrnfield extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'DocScrnField';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'docscrnid',
        'fieldnumber',
        'fieldprompt',
        'fieldhelp',
        'fieldtype',
        'fieldcalculation',
        'fielddropdownoptions',
        'fieldrequiredflag',
        'fieldrequiredcondition',
        'defaultvalue',
        'color1',
        'color1condition',
        'hideflag',
        'disableflag',
        'hidecondition',
        'disablecondition',
        'writebackflag',
        'writebacktable',
        'writebackcolumn',
        'lookupscript',
        'lookuptable',
        'lookupcolumn',
        'writebackroleid',
        'writebackcondition',
        'refreshscreenflag',
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
