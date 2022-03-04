<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class precedentdoconline extends Model
{

    protected $primaryKey = ['LanguageID','MajorNo','MinorNo','PrecedentBankID'];
    protected $table = 'PrecedentDocOnline';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'precedentbankid',
							'majorno',
							'minorno',
							'languageid',
							'author',
							'date',
							'time',
							'savedname',
							'comments'
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
        
