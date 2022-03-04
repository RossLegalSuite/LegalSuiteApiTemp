<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class messagesreceived extends Model
{

    protected $primaryKey = 'ID';
    protected $table = 'MessagesReceived';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'id',
							'message',
							'korbitecmsgidref',
							'importedflag',
							'importeddate',
							'matterid',
							'messagetype',
							'source',
							'employeeid'
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
        
