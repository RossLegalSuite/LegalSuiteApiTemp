<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class law_prop extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'LAW_Prop';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'erf_n',
        'prpty_desc_x',
        'prpty_type_x',
        'sect_title_unit_n',
        'cmplx_name_x',
        'lshld_x',
        'rtntn_a',
        'prchs_a',
        'prchs_d',
        'prpty_area_q',
        'bnded_to_x',
        'branch_bnded_to_x',
        'account_bnded_to_x',
        'seller_name_x',
        'seller_tel_n',
        'deed_of_trans_no',
        'property_id',
        'streetaddx',
        'suburb',
        'town',
        'managentx',
        'bondtoaccn',
        'applicationdate',
        'validitydate',
        'elecwateracc',
        'typeoftransaction',
        'assessmentrates',
        'reasonforapp',
        'valuationreq',
        'portionn',
        'userref',
        'lsw_bondprop_1id',
        'lsw_bondprop_2id',
        'rateextra1',
        'rateextra2',
        'rateextra3',
        'delivery_method',
        'adres_line1_x',
        'adres_line2_x',
        'adres_line3_x',
        'sect_title_door_n',
        'cntrt_name_x',
        'cntrt_price_a',
        'prpty_n',
        'elecacc',
        'wateracc',
        'rates_payable_i',
        'type_of_property',
        'prpty_measure_x',
        'effective_app_d',
        'parent_property_desc_x',
        'scheme_name_x',
        'scheme_n',
        'unit_type',
        'managing_agent_x',
        'managing_agent_tel_n',
        'owned_existing_unit',
        'region_x',
        'type_of_transaction',
        'developer_x',
        'total_num_erf',
        'grand_parent_erf_n',
        'app_ref_n',
        'parent_erf_n',
        'suburb_ext_n',
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
