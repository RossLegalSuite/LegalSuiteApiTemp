<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class todoitem extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ToDoItem';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'todogroupid',
        'description',
        'nextdocumentflag',
        'nextdocumentid',
        'days',
        'criticalstep',
        'lawmessageno',
        'weblinkmessage',
        'autonotifyflag',
        'autonotifymessage',
        'workingdaysflag',
        'basedateoption',
        'specificdaymask',
        'emproleid',
        'assignflag',
        'basedateoptionother',
        'docgenid',
        'excludecourtholidaysflag',
        'excludecourtrecessflag',
        'code',
        'todoitemgroupid',
        'basedateotherid',
        'beforeafteroption',
        'recurringflag',
        'virtualdate',
        'fnbmessageno',
        'optionalflag',
        'optionaleventid',
        'createoutlooktaskflag',
        'createoutlookappointmentflag',
        'apptshowas',
        'apptreminderset',
        'apptreminderminutesbeforestart',
        'apptlocation',
        'apptstarttime',
        'apptduration',
        'apptalldayevent',
        'apptsensitivity',
        'appteditflag',
        'period',
        'weekendsflag',
        'limittoavailableemployeesflag',
        'priority',
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
