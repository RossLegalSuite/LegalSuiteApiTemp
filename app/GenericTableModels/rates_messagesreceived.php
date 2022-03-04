<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class rates_messagesreceived extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Rates_MessagesReceived';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'korbitecmsgidref',
        'importedflag',
        'importeddate',
        'bondpropid',
        'messagetype',
        'source',
        'message',
        'law_trans_recordid',
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
