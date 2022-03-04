<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class empdesktopwidget extends Model
{
    protected $primaryKey = ['DesktopWidgetID', 'EmployeeID'];

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
        'collapsedflag',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }
}
