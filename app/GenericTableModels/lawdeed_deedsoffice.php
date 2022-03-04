<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class lawdeed_deedsoffice extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'LAWDeed_DeedsOffice';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'lawdeedid',
        'name',
        'code',
        'barcode',
        'lodgementnumber',
        'lawdeedenabledflag',
        'appearerdeedid',
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
