<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class finaldefs extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'FinalDefs';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'employeeid',
							'languageid',
							'buyerselleroption',
							'debitorcredit',
							'contents',
							'lookupoption',
							'sorter',
							'amount',
							'recordid',
							'vatableflag',
							'truecondition',
							'multiplyby'
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
        
