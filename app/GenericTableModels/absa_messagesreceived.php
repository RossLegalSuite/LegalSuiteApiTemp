<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class absa_messagesreceived extends Model
{
    protected $primaryKey = 'ID';

    protected $table = 'ABSA_MessagesReceived';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'id',
        'message',
        'importedflag',
        'importeddate',
        'messagetype',
        'matterid',
        'employeeid',
        'processingsequence',
        'messagenumber',
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
