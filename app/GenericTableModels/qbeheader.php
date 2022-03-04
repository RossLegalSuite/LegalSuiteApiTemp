<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class qbeheader extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'QBEHeader';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'maintableid',
        'description',
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
