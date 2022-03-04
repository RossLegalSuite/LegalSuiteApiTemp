<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_ctl extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_Ctl';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'importverification',
							'filterworkgroupbranchflag',
							'filterworkgroupbranchid',
							'filterinstitutionflag',
							'filterinstitutioncode',
							'statusflag',
							'filterstatuscode',
							'datefromflag',
							'datefrom',
							'datetoflag',
							'dateto',
							'archivedflag',
							'archivedrecord',
							'createlswmatter',
							'updatelswmatter',
							'localauthority_default',
							'employeeflag',
							'employeerecord'
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
        
