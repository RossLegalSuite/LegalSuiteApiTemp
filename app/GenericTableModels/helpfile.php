<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class helpfile extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'HelpFile';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'description',
							'category',
							'filename'
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
        
