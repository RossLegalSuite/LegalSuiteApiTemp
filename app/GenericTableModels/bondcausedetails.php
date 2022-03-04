<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bondcausedetails extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'BondCauseDetails';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'bondcauseid',
        'description',
        'englishwording',
        'afrikaanswording',
        'deedsofficefee',
        'tariffpercentage',
        'notransferdutyflag',
        'amountpercentage',
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
