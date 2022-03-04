<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class lawmessagechild extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAWMessageChild';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'parentid',
							'type',
							'format',
							'prompt',
							'name',
							'helptext',
							'options',
							'maxsize',
							'requiredflag',
							'sorter',
							'lscolumn'
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
        
