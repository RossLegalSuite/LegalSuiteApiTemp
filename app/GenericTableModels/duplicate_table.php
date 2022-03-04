<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class duplicate_table extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'duplicate_table';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'suiteid',
							'lawref',
							'clientuserid',
							'clientbranchid',
							'clientref',
							'workgroupuserid',
							'workgroupbranchid',
							'workgroupref',
							'status',
							'matterid',
							'datereceived',
							'datelodged',
							'dateupforfees',
							'dateregistered',
							'datewithdrawn',
							'rgstn_n',
							'acnt_name_x',
							'carrier_n',
							'cmbnd_prpty_desc_x',
							'cmbnd_prpty_short_desc_x',
							'bond_q',
							'crspc_lang_i',
							'rgstn_a',
							'instt_incom_p',
							'loan_value_p',
							'cltrl_reqd_a',
							'total_loan_a',
							'loan_a',
							'loan_type_x',
							'brnch_scrty_a',
							'rdvnc_a',
							'surety_need_y',
							'surety_reqd_a',
							'adntl_sum_a',
							'prnpl_debt_a',
							'total_finc_chrge_a',
							'total_fin1_chrge_a',
							'total_instt_a',
							'frthr_aditl_a',
							'sum_insrd_a',
							'rgstn_cost_a',
							'rgstn_cost_paid_by_x',
							'assmt_fee_a',
							'assmt_fee_paid_by_x',
							'initn_fee_a',
							'initn_fee_paid_by_x',
							'servc_fee_a',
							'servc_fee_paid_by_x',
							'bond_duty_a',
							'rduce_mortg_y',
							'tot_asrnc_a',
							'insnc_premm_a',
							'term_months_q',
							'intst_only_y',
							'trnfr_atrny_x',
							'trnfr_atrny_tel_n',
							'cancel_bond_att_x',
							'cancel_bond_acc_x',
							'cancel_bond_acc_n',
							'instal1_a',
							'instal2_a',
							'instal3_a',
							'branch_to',
							'branch_from',
							'hlgc_indmy_fee_a',
							'dlvry_chanl',
							'estate_agency_x',
							'estate_agent_x',
							'estate_agency_tel_n',
							'eng_reg_name',
							'eng_reg_addr_1',
							'eng_reg_addr_2',
							'eng_reg_addr_3',
							'reg_phone',
							'reg_code',
							'afr_reg_name',
							'afr_reg_addr_1',
							'afr_reg_addr_2',
							'afr_reg_addr_3',
							'salutation',
							'intst_from_d',
							'intst_to_d',
							'cmplt_d',
							'commt_a',
							'hmln_office',
							'hmln_user_x',
							'hmln_user2_x',
							'hmln_email_x',
							'user_tel_n',
							'network_sales_y',
							'sales_cons_x',
							'sales_cons_tel_n',
							'est_ebank_ins',
							'est_insrnc_premm',
							'hlp_prem_a',
							'rate_p',
							'rate_terms_x',
							'rate_period_n',
							'crw_p',
							'misc_cost_a',
							'tran_duty_a',
							'tran_fee_a',
							'tran_fee_paid_by_x',
							'tran_fee_discnt_p',
							'csc_addr1_x',
							'csc_addr2_x',
							'csc_addr3_x',
							'csc_addr4_x',
							'csc_c',
							'dra_addr1_x',
							'dra_addr2_x',
							'dra_addr3_x',
							'dra_addr4_x',
							'dra_c',
							'sales_source_x',
							'war_rate_p',
							'stamp_duty_a',
							'bond_grantor_x',
							'comm_a',
							'cooling_off_y',
							'deposit_a',
							'occup_d',
							'subject_prop_y',
							'susp_conditions_y',
							'estate_agent_brch_x',
							'archived',
							'salconemail',
							'occup_i',
							'totaldepa',
							'totalcomma',
							'fixedratep',
							'lsw_agency_party_id',
							'lsw_agency_parlang_1id',
							'lsw_agency_parlang_2id',
							'lsw_trfatt_party_id',
							'lsw_trfatt_parlang_1id',
							'lsw_trfatt_parlang_2id',
							'lsw_bndedto_party_id',
							'lsw_bndedto_parlang_1id',
							'lsw_bndedto_parlang_2id',
							'comment',
							'prnpl_a',
							'susp_conditions_d',
							'subj_conditions_d',
							'mortgage_originator_x',
							'mortgage_originator_contact_x',
							'mortgage_originator_tel_n',
							'occup_first_i',
							'excl_use_area',
							'facility_acc_n',
							'aditl_a',
							'facility_sum_a',
							'repay_type_x',
							'service_brch_x',
							'service_brch_tel_n',
							'call_centre_tel_n',
							'transaction_fee_x',
							'security_variation_fee_a',
							'cxl_loan_a',
							'cxl_loan_d',
							'user_fax_n',
							'cxl_misc_cost_a',
							'cxl_bond_duty_a',
							'paid_by_x',
							'cede_instit_x',
							'docs_att_y',
							'intst_a',
							'shortfall_a',
							'guar_a',
							'prpty_use_x',
							'frstm_home_buyr_y',
							'captl_subsy_a',
							'subsy_a',
							'cmpny_trust_name_x',
							'occup_rent_a',
							'developer_x',
							'mortgage_originator_ref_n',
							'mortgage_originator_deal_y',
							'surety_reqrd_by_x',
							'current_bal_a',
							'trnfr_atrny_fax_n',
							'embed_y',
							'total_repay_a',
							'consolidated_prchs_a',
							'lsw_loanorig_party_id',
							'lsw_loanorig_parlang_1id',
							'lsw_loanorig_parlang_2id',
							'total_int_a',
							'total_cap_rep_all_a',
							'bplus_a',
							'def_init_a',
							'calc_bl_loan_less_con_a',
							'calc_oa_fac_less_init_a',
							'calc_oa_servc_fee_plus_tran_fee_a',
							'calc_loan_less_bp_less_init_a',
							'insnc_quo_pol_n',
							'insnc_premm_m_a',
							'insnc_co_name_x',
							'insnc_cost_a',
							'insnc_add_fees_a',
							'ncr_reg_n',
							'step_up_rate_p',
							'init_fee_max_a',
							'min_loan_value_p',
							'max_loan_value_p',
							'min_int_rate_p',
							'future_use_a',
							'estate_agency_reg_n',
							'mortgage_originator_reg_n',
							'switching_finance_a',
							'switch_rate_p',
							'instal_switch_a',
							'total_sf_finc_chrge_a'
    ];

	public function setdateAttribute($value)
	{
		$this->attributes['date'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

	public function setcreateddateAttribute($value)
	{
		$this->attributes['createddate'] = $value ? (String)ModelHelper::convertClarionDate($value) : '';
	}

}
        
