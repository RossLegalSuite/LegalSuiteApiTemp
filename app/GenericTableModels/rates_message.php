<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class rates_message extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Rates_Message';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'messageid',
        'description',
        'direction',
        'help',
        'messagetype',
        'source',
        'newstate',
        'state1flag',
        'state2flag',
        'applicablelocalauthoritys',
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
