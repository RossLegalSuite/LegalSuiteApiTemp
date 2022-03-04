<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class nedctl extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'NedCtl';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'receivepath',
        'diarypath',
        'clientid',
        'mattertypeid',
        'docgenid',
        'scheduleid',
        'clientfeesheetid',
        'inboxlocation',
        'outboxlocation',
        'todogroupid',
        'importverification',
        'donotaddpartiesflag',
        'donotupdatetrfpartiesflag',
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
