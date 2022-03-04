<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class empdesktopwidget extends Model
{

    protected $primaryKey = ['DesktopWidgetID','EmployeeID'];
    protected $table = 'EmpDesktopWidget';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'employeeid',
							'desktopwidgetid',
							'locationx',
							'locationy',
							'height',
							'width',
							'collapsedflag'
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
        
