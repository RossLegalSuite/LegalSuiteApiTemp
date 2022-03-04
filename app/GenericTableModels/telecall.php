<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class telecall extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'TeleCall';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'importid',
        'date',
        'time',
        'duration',
        'cost',
        'phonenumber',
        'extention',
        'trunk',
        'ringtime',
        'carrier',
        'calltype',
        'disbursement',
        'fee',
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
