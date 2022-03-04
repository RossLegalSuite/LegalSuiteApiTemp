<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_intrates extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_IntRates';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'ftranid',
							'interest_number',
							'interest_i',
							'interestpercentage',
							'interestfromdate',
							'interesttodate',
							'interest_plus_minus',
							'interest_onvalue',
							'ft_number',
							'interest_type'
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
        
