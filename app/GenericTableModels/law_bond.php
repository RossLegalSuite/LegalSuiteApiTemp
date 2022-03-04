<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_bond extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_Bond';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'number',
        'cxl_bond_n',
        'lsw_bondcancid',
        'cxl_bond_in_favour_of',
        'cxl_mortgagors',
        'cxl_bond_a',
        'cxl_adntl_a',
        'cxl_total_prpts',
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
