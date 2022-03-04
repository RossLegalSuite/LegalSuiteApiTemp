<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class ag_message extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'AG_Message';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'messageid',
        'description',
        'automaticflag',
        'state1flag',
        'state2flag',
        'state3flag',
        'state4flag',
        'state5flag',
        'state6flag',
        'state7flag',
        'state8flag',
        'state9flag',
        'state10flag',
        'newstate',
        'help',
        'direction',
        'messagetype',
        'docgenid',
        'state11flag',
        'state12flag',
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
