<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class deadmatter extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'DeadMatter';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'matterid',
							'fileref',
							'description',
							'oldcode',
							'alternateref',
							'archiveno',
							'storagenumber',
							'storagedate',
							'storagelocation',
							'clientid',
							'employeeid',
							'mattertypeid'
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
        
