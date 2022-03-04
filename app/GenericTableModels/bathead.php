<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bathead extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'BatHead';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'createdbyid',
        'createddate',
        'booktype',
        'postedflag',
        'postingid',
        'postedbyid',
        'inusebyid',
        'printedflag',
        'completeflag',
        'verifyflag',
        'restrictpostflag',
        'posteddate',
        'postedyear',
        'postedperiod',
        'comments',
        'screenid',
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
