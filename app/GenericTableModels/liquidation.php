<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class liquidation extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'Liquidation';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'referenceno',
							'description',
							'fulldescription',
							'memo',
							'matpartyid',
							'liquidationtypeid',
							'amount',
							'taxableamount',
							'isrealised',
							'reference',
							'code',
							'rate',
							'bankingid',
							'linkedliquidationid',
							'bondpropid',
							'data',
							'date',
							'refrate'
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
        
