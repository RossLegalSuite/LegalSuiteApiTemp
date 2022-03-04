<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class ph_message extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'PH_Message';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'messagetype',
							'description',
							'direction',
							'state0flag',
							'state1flag',
							'state2flag',
							'state3flag',
							'state4flag',
							'state5flag',
							'newstate',
							'help',
							'sorter',
							'bondflag',
							'transferflag',
							'cancellationflag'
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
        
