<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class precedentdoc extends Model
{
    protected $primaryKey = ['LanguageID', 'MajorNo', 'MinorNo', 'PrecedentBankID'];

    protected $table = 'PrecedentDoc';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'precedentbankid',
        'majorno',
        'minorno',
        'languageid',
        'employeeid',
        'date',
        'time',
        'savedname',
        'comments',
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
