<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class rates_bondpropmessage extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Rates_BondPropMessage';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'bondpropid',
        'date',
        'time',
        'messageid',
        'employeeid',
        'details',
        'readflag',
        'rates_messagesreceivedid',
        'completedflag',
        'xmlstring',
        'source',
        'law_trans_recordid',
        'internalxmlstring',
        'korbitecmsgidref',
        'draftrequestid',
        'draftrequesturl',
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
