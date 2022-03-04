<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class invoicematter extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'InvoiceMatter';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'invoiceno',
							'consolidateid',
							'matterid',
							'lastinvoiceno',
							'lastinvoiceactual',
							'lastinvoicereserved',
							'lastinvoiceinvested',
							'thisinvoiceactual',
							'thisinvoicereserved',
							'thisinvoiceinvested',
							'actual',
							'reserved',
							'invested',
							'agecurrent',
							'age30day',
							'age60day',
							'age90day',
							'age120day',
							'age150day',
							'age180day',
							'startbatchid',
							'endbatchid',
							'type',
							'year',
							'period',
							'date'
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
        
