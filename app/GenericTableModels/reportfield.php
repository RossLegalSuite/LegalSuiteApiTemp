<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class reportfield extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'ReportField';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'fileid',
        'description',
        'name',
        'type',
        'width',
        'decplaces',
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
