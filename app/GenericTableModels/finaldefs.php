<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class finaldefs extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'FinalDefs';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'employeeid',
        'languageid',
        'buyerselleroption',
        'debitorcredit',
        'contents',
        'lookupoption',
        'sorter',
        'amount',
        'recordid',
        'vatableflag',
        'truecondition',
        'multiplyby',
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
