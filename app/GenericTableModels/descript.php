<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class descript extends Model
{
    protected $primaryKey = 'LanguageID';

    protected $table = 'Descript';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'languageid',
        'reportleftheader',
        'reportrightheader',
        'andword',
        'plaintiffword',
        'plaintiffwords',
        'defendantword',
        'defendantwords',
        'applicantword',
        'applicantwords',
        'respondentword',
        'respondentwords',
        'unmaritaldescription',
        'inmaritaldescription',
        'oumaritaldescription',
        'fomaritaldescription',
        'otmaritaldescription',
        'divmaritaldescription',
        'widmaritaldescription',
        'cuimaritaldescription',
        'cuomaritaldescription',
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
