<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class colcost extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'ColCost';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'documentcode',
        'description',
        'amount',
        'type',
        'perdefendant',
        'defaultcost',
        'lookuptableid',
        'vatflag',
        'category',
        'attorneyclientflag',
        'excludefromdocumentflag',
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
