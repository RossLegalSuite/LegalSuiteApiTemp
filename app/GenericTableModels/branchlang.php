<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class branchlang extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'BranchLang';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'branchid',
        'languageid',
        'physicalline1',
        'physicalline2',
        'physicalline3',
        'physicalline4',
        'physicalcode',
        'postalline1',
        'postalline2',
        'postalline3',
        'postalline4',
        'postalcode',
        'docex',
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
