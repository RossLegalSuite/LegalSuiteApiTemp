<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class simpleuser extends Model
{

    protected $primaryKey = 'Oid';
    protected $table = 'SimpleUser';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'oid',
							'username',
							'fullname',
							'isactive',
							'isadministrator',
							'changepasswordonfirstlogon',
							'password',
							'optimisticlockfield',
							'gcrecord'
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
        
