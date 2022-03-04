<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class electroniclinklog extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'ElectronicLinkLog';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'date',
        'time',
        'message1',
        'message2',
        'message3',
        'matterid',
        'source',
        'successflag',
        'employeeid',
        'messageno',
        'otherrecordid',
        'direction',
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
