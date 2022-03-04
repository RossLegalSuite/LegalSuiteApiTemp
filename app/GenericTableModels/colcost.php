<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class colcost extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'ColCost';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'documentcode',
							'description',
							'amount',
							'type',
							'perdefendant',
							'defaultcost',
							'lookuptableid',
							'vatflag',
							'category',
							'attorneyclientflag',
							'excludefromdocumentflag'
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
        
