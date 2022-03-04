<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class cancdefs extends Model
{
    protected $primaryKey = ['EmployeeID', 'LanguageID'];

    protected $table = 'CancDefs';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'employeeid',
        'languageid',
        'registrar',
        'documentssignedat',
        'conveyancerfirstnames',
        'conveyancerlastname',
        'conveyancerinitials',
        'commissioner',
        'commissionerdesignation',
        'lodgingagentid',
        'conveyancerpracticeno',
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
