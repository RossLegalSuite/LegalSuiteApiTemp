<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_agency extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_Agency';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'agentn',
        'agencynamex',
        'agentnamex',
        'agentbranchx',
        'comma',
        'engregname',
        'engregadd1',
        'engregadd2',
        'engregadd3',
        'regphone',
        'regcode',
        'afrregname',
        'afrregadd1',
        'afrregadd2',
        'afrregadd3',
        'lsw_party_id',
        'lsw_parlang_1id',
        'lsw_parlang_2id',
        'estate_agent_cell_n',
        'estate_agent_email_add_x',
        'estate_agent_deal_n',
        'estate_agency_email_add_x',
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
