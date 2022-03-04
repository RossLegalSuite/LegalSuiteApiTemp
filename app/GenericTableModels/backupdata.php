<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

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
							'lastbackupdate'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
