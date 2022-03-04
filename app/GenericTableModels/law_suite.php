<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_suite extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'LAW_Suite';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'suiteid',
        'description',
        'partyid',
        'docgenid',
        'todogroupid',
        'testflag',
        'transfersflag',
        'sequence01',
        'sequence02',
        'sequence03',
        'sequence04',
        'sequence05',
        'sequence06',
        'sequence07',
        'sequence08',
        'sequence09',
        'sequence10',
        'sequence11',
        'sequence12',
        'sequence13',
        'sequence14',
        'sequence15',
        'sequence16',
        'sequence17',
        'sequence18',
        'sequence19',
        'sequence20',
        'sequence21',
        'sequence22',
        'sequence23',
        'sequence24',
        'sequence25',
        'sequence26',
        'sequence27',
        'sequence28',
        'sequence29',
        'sequence30',
        'alldebtortransactions',
        'mattertypeid',
        'extrascreenid',
        'floating01',
        'floating02',
        'floating03',
        'floating04',
        'floating05',
        'floating06',
        'floating07',
        'floating08',
        'floating09',
        'floating10',
        'floating11',
        'floating12',
        'floating13',
        'floating14',
        'floating15',
        'floating16',
        'floating17',
        'floating18',
        'floating19',
        'floating20',
        'floating21',
        'floating22',
        'floating23',
        'floating24',
        'floating25',
        'floating26',
        'floating27',
        'floating28',
        'floating29',
        'floating30',
        'versionnumber',
        'defaultemployeeflag',
        'defaultemployeeid',
        'ag_institutionkref',
        'ag_institutionname',
        'rateslinkcompany',
        'donotaddpartiesflag',
        'donotupdatetrfpartiesflag',
        'ag_instructiontype',
        'claimamounttype',
        'lexisdocexchange',
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
