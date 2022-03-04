<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_locauth extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_LocAuth';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'lawnumber',
        'description',
        'suiteid',
        'code',
        'testflag',
        'friendlyname',
        'rateslinkcompany',
        'deedsofficeid',
        'councilid',
        'active',
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
