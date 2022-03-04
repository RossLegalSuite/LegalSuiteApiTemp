<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class estate extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'Estate';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'deathdate',
        'signeddate',
        'dependantcount',
        'masterreference',
        'signeddeath',
        'placedeath',
        'deedsoffice',
        'deathdistrict',
        'deathdivision',
        'estatenumber',
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
