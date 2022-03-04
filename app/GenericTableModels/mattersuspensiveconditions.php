<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class mattersuspensiveconditions extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'MatterSuspensiveConditions';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'description',
        'suspensivecondition',
        'duedate',
        'completeddate',
        'sorter',
        'responsibleparty',
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
