<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bondguar extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'BondGuar';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'sorter',
        'name',
        'address',
        'phrase',
        'amount',
        'payableat',
        'creditaccount',
        'creditname',
        'acbnumber',
        'guaranteenumber',
        'sequencenumber',
        'maximum',
        'stampflag',
        'stampamount',
        'interestflag',
        'interestindicator',
        'interestpercent',
        'intereston',
        'interestfrom',
        'phrase1',
        'phrase2',
        'phrase3',
        'interestcompoundedflag',
        'interest1flag',
        'interest1indicator',
        'interest1percent',
        'interest1on',
        'interest1from',
        'interest1compoundedflag',
        'interest2flag',
        'interest2indicator',
        'interest2percent',
        'interest2on',
        'interest2from',
        'interest2compoundedflag',
        'interest3flag',
        'interest3indicator',
        'interest3percent',
        'interest3on',
        'interest3from',
        'interest3compoundedflag',
        'interestto',
        'interest1to',
        'interest2to',
        'interest3to',
        'customiseflag',
        'customise1flag',
        'customise2flag',
        'customise3flag',
        'bankname',
        'bankcodeid',
        'card_holder_name',
        'atm_card_number',
        'additionalconditionsflag',
        'additionalconditions',
        'conditions',
        'paymentreference',
        'type',
        'guaranteehubstatus',
        'guaranteehubidentity',
        'guaranteepurpose',
        'conditionseditableflag',
        'guaranteerequired',
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
