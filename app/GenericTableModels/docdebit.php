<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class docdebit extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'Docdebit';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'documentid',
        'feecodeid',
        'recordid',
        'truecondition',
        'duplicatefeenoteoption',
        'proformaflag',
        'sorter',
        'descriptionmethod',
        'customenglishwording',
        'customafrikaanswording',
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
