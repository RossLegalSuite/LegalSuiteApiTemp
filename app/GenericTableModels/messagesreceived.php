<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class messagesreceived extends Model
{
    protected $primaryKey = 'ID';

    protected $table = 'MessagesReceived';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'id',
        'message',
        'korbitecmsgidref',
        'importedflag',
        'importeddate',
        'matterid',
        'messagetype',
        'source',
        'employeeid',
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
