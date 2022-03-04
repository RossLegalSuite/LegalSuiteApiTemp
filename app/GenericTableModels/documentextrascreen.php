<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class documentextrascreen extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'DocumentExtraScreen';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'documentid',
							'docscrnid',
							'truecondition'
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
        
