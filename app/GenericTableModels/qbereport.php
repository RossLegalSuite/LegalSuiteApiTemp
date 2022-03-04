<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class qbereport extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'QBEReport';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'maintableid',
        'description',
        'reportheading',
        'reportsubheading',
        'orderbycolumn1',
        'orderbycolumn2',
        'pagenumbersflag',
        'reportdetailsflag',
        'fontsize',
        'reportdestination',
        'check1',
        'check2',
        'check3',
        'check4',
        'check5',
        'check6',
        'check7',
        'check8',
        'check9',
        'check10',
        'check11',
        'check12',
        'check13',
        'check14',
        'check15',
        'check16',
        'check17',
        'check18',
        'check19',
        'check20',
        'check21',
        'check22',
        'check23',
        'check24',
        'check25',
        'check26',
        'check27',
        'check28',
        'check29',
        'check30',
        'check31',
        'check32',
        'check33',
        'check34',
        'check35',
        'check36',
        'check37',
        'check38',
        'check39',
        'check40',
        'check41',
        'check42',
        'check43',
        'check44',
        'check45',
        'check46',
        'check47',
        'check48',
        'check49',
        'check50',
        'check51',
        'check52',
        'check53',
        'check54',
        'check55',
        'check56',
        'check57',
        'check58',
        'check59',
        'check60',
        'check61',
        'check62',
        'check63',
        'check64',
        'check65',
        'check66',
        'check67',
        'check68',
        'check69',
        'check70',
        'check71',
        'check72',
        'check73',
        'check74',
        'check75',
        'check76',
        'check77',
        'check78',
        'check79',
        'check80',
        'check81',
        'check82',
        'check83',
        'check84',
        'check85',
        'check86',
        'check87',
        'check88',
        'check89',
        'check90',
        'check91',
        'check92',
        'check93',
        'check94',
        'check95',
        'check96',
        'check97',
        'check98',
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
