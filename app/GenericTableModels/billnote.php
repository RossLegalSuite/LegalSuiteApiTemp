<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class billnote extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BillNote';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'matterid',
							'date',
							'sorter',
							'description',
							'unitid',
							'unitflag',
							'unittext',
							'unitquantity',
							'type',
							'amount',
							'netamount',
							'vatrate',
							'vattypeflag',
							'recordid',
							'attorneyclientflag'
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
        
