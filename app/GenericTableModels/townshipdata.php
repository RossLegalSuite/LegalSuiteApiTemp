<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class townshipdata extends Model
{
    protected $primaryKey = 'MatterID';

    protected $table = 'TownshipData';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'matterid',
        'type',
        'name',
        'generalplannumber',
        'generalplandate',
        'diagramnumber',
        'diagramdate',
        'conditions',
        'units',
        'realrights',
        'proclamationnumber',
        'proclamationdate',
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
