<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class mattersearchresults extends Model
{
    protected $primaryKey = 'MatterSearchID';

    protected $table = 'MatterSearchResults';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'mattersearchid',
        'usertoken',
        'vendorcode',
        'deedsoffice',
        'documentnumber',
        'microfilmrefno',
        'reference',
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
