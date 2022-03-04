<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Branch';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'description',
        'telephone',
        'fax',
        'email',
        'workgroupbranchid',
        'inboxlocation',
        'outboxlocation',
        'rtflocation',
        'datalinkinboxlocation',
        'datalinkoutboxlocation',
        'datalinksavedlocation',
        'regibondpath',
        'regibondbranchcode',
        'weblinkinboxlocation',
        'weblinkoutboxlocation',
        'weblinkattorneybankref',
        'ag_attorneykref',
        'ag_attorneykeypair',
        'lawdeedid',
        'certificatethumbprint',
        'trustbankid',
        'businessbankid',
        'cacsusercode',
        'kodaletterhead',
        'appearerpoaid',
        'appearerdeedid',
        'lodgementnumber',
        'partyid',
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
