<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class filenotearchive extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'FileNoteArchive';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'docfilenoteid',
							'date',
							'description',
							'employeeid',
							'stageid',
							'internalflag',
							'origin',
							'autonotifydate',
							'exportedflag',
							'doclogid',
							'time'
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
        
