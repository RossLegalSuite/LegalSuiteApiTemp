<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class sars_mattermessage extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'SARS_MatterMessage';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'date',
        'time',
        'employeeid',
        'description',
        'td_referencenumber',
        'statusflag',
        'status',
        'errormessage',
        'xmlstring',
        'sarsxmlstring',
        'payableamt',
        'percentage1',
        'payableamt1',
        'calculatedpayableamt1',
        'percentage2',
        'payableamt2',
        'calculatedpayableamt2',
        'percentage3',
        'payableamt3',
        'calculatedpayableamt3',
        'percentage4',
        'payableamt4',
        'calculatedpayableamt4',
        'subtotalpayableamt',
        'penaltyinterestamt',
        'totalpayableamt',
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
