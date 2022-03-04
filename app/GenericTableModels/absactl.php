<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class absactl extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'ABSACtl';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'regibondpath',
        'regibondcommand',
        'clientid',
        'mattertypeid',
        'docgenid',
        'scheduleid',
        'clientfeesheetid',
        'afrikaansid',
        'englishid',
        'rtflocation',
        'licencenumber',
        'virginclientid',
        'sanlamclientid',
        'attorneycode',
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
