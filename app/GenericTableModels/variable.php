<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class variable extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Variable';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'varfileid',
							'contents',
							'description',
							'heading',
							'customformat',
							'type',
							'truecondition',
							'falsecondition',
							'specialfield',
							'alignh',
							'alignv',
							'wordwrap',
							'formattype',
							'formatstring',
							'sqlflag'
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
        
