<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class guaranteehubrequestattachment extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'GuaranteeHubRequestAttachment';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'requestidentifier',
        'attachmentidentifier',
        'name',
        'filename',
        'addedby',
        'date',
        'time',
        'doclogid',
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
