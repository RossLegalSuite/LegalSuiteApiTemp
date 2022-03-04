<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class absa_mattermessage extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ABSA_MatterMessage';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'date',
        'readflag',
        'actiondate',
        'details',
        'employeeid',
        'messagetype',
        'time',
        'xmlstring',
        'messagenumber',
        'messagedescription',
        'messagedirection',
        'messagesreceivedid',
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
