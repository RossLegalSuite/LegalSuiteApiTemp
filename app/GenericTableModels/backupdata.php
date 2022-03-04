<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class backupdata extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'BackupData';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'path',
        'customflag',
        'mergedflag',
        'clausesflag',
        'particularsofclaimflag',
        'letterheadflag',
        'databaseflag',
        'databasefilename',
        'lastdocumentdate',
        'lastdatabasedate',
        'lastbackupdate',
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
