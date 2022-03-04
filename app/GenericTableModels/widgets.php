<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class widgets extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'Widgets';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'title',
        'description',
        'type',
        'widgetactionid',
        'widgetcontentid',
        'widgetbackgroundid',
        'homemenuicon',
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
