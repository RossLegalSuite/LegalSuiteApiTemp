<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class docfilenote extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'DocFileNote';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'documentid',
        'description',
        'stageid',
        'truecondition',
        'days',
        'workingdaysflag',
        'basedateoption',
        'basedateoptionother',
        'specificdaymask',
        'excludecourtholidaysflag',
        'excludecourtrecessflag',
        'action',
        'internalflag',
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
