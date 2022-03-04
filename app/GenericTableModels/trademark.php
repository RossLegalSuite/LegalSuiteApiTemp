<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class trademark extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Trademark';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'name',
        'description',
        'alternative1',
        'alternative2',
        'renewaldate',
        'applicationdate',
        'applicationnumber',
        'registrationdate',
        'registrationnumber',
        'countryid',
        'agentid',
        'tradetypeid',
        'classification',
        'wildcard',
        'poanumber',
        'wildcard1',
        'donotsearchflag',
        'imagefile',
        'metaphonename',
        'metaphone1',
        'metaphone2',
        'wildcard2',
        'wildcard3',
        'proprietor',
        'tradeclassid',
        'notes',
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
