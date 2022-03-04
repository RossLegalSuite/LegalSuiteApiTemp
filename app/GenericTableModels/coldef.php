<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class coldef extends Model
{
    protected $primaryKey = ['EmployeeID', 'LanguageID'];

    protected $table = 'ColDef';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'employeeid',
        'languageid',
        'attorneyfullnames',
        'signatory',
        'placesigned',
        'courtboxnumber',
        'documentfooter',
        'interestrate',
        'vatrate',
        'loddaystorespond',
        'sumdaystorespond',
        'suminterestclause',
        'jurisdictionclause',
        'highcourtdivision',
        'highcourtaddress',
        'highcourtofficial',
        'magcourtdistrict',
        'magcourtheldat',
        'magcourtofficial',
        'repaymentfooter',
        'magcourtaddress',
        'emocommissionpercent',
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
