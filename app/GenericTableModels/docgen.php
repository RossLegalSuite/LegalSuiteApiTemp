<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class docgen extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'Docgen';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'code',
							'description',
							'type',
							'primarydirectory',
							'noofusers',
							'licencenumber',
							'directors',
							'additionalpercentage',
							'stamponadditionalflag',
							'logofilelocation',
							'todogroupid',
							'additionalroundedflag',
							'feesonadditionalflag',
							'defaultbankcodeid',
							'liveupdateflag',
							'downloadoption',
							'checksheetid',
							'lawdeedid',
							'ag_institutionkref',
							'ag_institutionkreftest',
							'ag_institutionname',
							'checkonlinedocumentsflag',
							'disableficaflag',
							'donotshowrecommendeddocumentsflag',
							'hideaccessflag',
							'hideextrascreenflag',
							'hidestagesflag',
							'hidefeeestimateflag',
							'hideprescribesonflag',
							'hidefilingcabinetflag',
							'hideplanofactionflag',
							'appearerpoaid',
							'appearerdeedid',
							'guaranteesigninglimit',
							'guaranteeauthorisedsignatories'
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
        
