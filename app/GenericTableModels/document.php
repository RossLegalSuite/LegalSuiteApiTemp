<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class document extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Document';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'docgenid',
							'description',
							'shortname',
							'separatedocumentflag',
							'roleid',
							'printcopies',
							'fileid',
							'freezeflag',
							'displaycriteriastring',
							'displaycriteriaflag',
							'docscrnflag',
							'docscrnid',
							'choosepartyflag',
							'languageoverride',
							'languageroleid',
							'promptfordescriptionflag',
							'printonlyflag',
							'debitdebtorflag',
							'donotsavedocumentflag',
							'logofilelocation',
							'doccategoryid',
							'matterdisplayfilter',
							'partydisplayfilter',
							'promptfordeliveryflag',
							'casetype',
							'defaultdeliveryid',
							'doclogcategoryid',
							'swoppartiesflag',
							'docscrntruecondition',
							'comments',
							'displayname',
							'letterflag',
							'donotdisplayflag',
							'olddocumentflag',
							'kodadocumentflag',
							'freezedisplaycriteriaflag',
							'bondpropdisplayfilter'
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
        
