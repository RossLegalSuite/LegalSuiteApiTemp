<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class docfoxdocumentdownload extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'DocFoxDocumentDownload';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'employeeid',
        'partyid',
        'date',
        'time',
        'docfoxid',
        'doclogid',
        'filename',
        'requestjson',
        'response',
        'docfoxdocumentid',
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
