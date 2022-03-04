<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class branchlang extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'BranchLang';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'branchid',
							'languageid',
							'physicalline1',
							'physicalline2',
							'physicalline3',
							'physicalline4',
							'physicalcode',
							'postalline1',
							'postalline2',
							'postalline3',
							'postalline4',
							'postalcode',
							'docex'
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
        
