<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class branch extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Branch';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'description',
							'telephone',
							'fax',
							'email',
							'workgroupbranchid',
							'inboxlocation',
							'outboxlocation',
							'rtflocation',
							'datalinkinboxlocation',
							'datalinkoutboxlocation',
							'datalinksavedlocation',
							'regibondpath',
							'regibondbranchcode',
							'weblinkinboxlocation',
							'weblinkoutboxlocation',
							'weblinkattorneybankref',
							'ag_attorneykref',
							'ag_attorneykeypair',
							'lawdeedid',
							'certificatethumbprint',
							'trustbankid',
							'businessbankid',
							'cacsusercode',
							'kodaletterhead',
							'appearerpoaid',
							'appearerdeedid',
							'lodgementnumber',
							'partyid'
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
        
