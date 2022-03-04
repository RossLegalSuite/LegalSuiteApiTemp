<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class lawdeed_control extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAWDeed_Control';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'latestdate',
        'deedsoffices',
        'mattertypes',
        'banks',
        'mortgageoriginators',
        'statuses',
        'firmbranch',
        'paralegal',
        'vendortoken',
        'docgencodes',
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
