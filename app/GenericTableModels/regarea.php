<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class regarea extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'RegArea';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'areanumber',
        'areadescription',
        'inextent',
        'heldby',
        'regsectid',
        'matterid',
        'sorter',
        'conditionclauseid',
        'conditionclauseflag',
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
