<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class lawdeed_instructingparalegal extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAWDeed_InstructingParaLegal';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'lawdeedid',
        'firstname',
        'lastname',
        'nonactive',
        'instructingfirmlawdeedid',
        'instructingbranchlawdeedid',
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
