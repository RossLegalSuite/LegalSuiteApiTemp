<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class cancdefs extends Model
{

    protected $primaryKey = ['EmployeeID','LanguageID'];
    protected $table = 'CancDefs';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'employeeid',
							'languageid',
							'registrar',
							'documentssignedat',
							'conveyancerfirstnames',
							'conveyancerlastname',
							'conveyancerinitials',
							'commissioner',
							'commissionerdesignation',
							'lodgingagentid',
							'conveyancerpracticeno'
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
        
