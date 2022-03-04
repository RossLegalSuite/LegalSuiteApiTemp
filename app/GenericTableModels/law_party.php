<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_party extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_Party';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'cust_n',
							'cust_name_x',
							'title',
							'initials',
							'last_name_x',
							'first_name_x',
							'postl_line1_x',
							'postl_line2_x',
							'postl_line3_x',
							'postl_c',
							'rsdtl_line1_x',
							'rsdtl_line2_x',
							'rsdtl_line3_x',
							'rsdtl_c',
							'home_tel_n',
							'busns_tel_n',
							'cell_tel_n',
							'id_type_x',
							'cust_id_n',
							'marital_status_x',
							'surity_i',
							'prim_app_y',
							'perm_res_y',
							'cust_role_x',
							'alt_contact_x',
							'alt_tel_n',
							'crspc_lang_i',
							'party_i',
							'emailaddx',
							'futresline1x',
							'futresline2x',
							'futresline3x',
							'futresc',
							'lsw_party_id',
							'lsw_parlang_1id',
							'lsw_parlang_2id',
							'signatory_x',
							'notification_method_x',
							'service_y',
							'sa_citzn_y',
							'cust_birth_d',
							'dpndt_q',
							'ocptn_desc_x',
							'empmt_sttus_x',
							'employ_n',
							'emplr_name_x',
							'emplr_fax_n',
							'emplr_email_add_x',
							'empmt_period_q',
							'prev_emplr_name_x',
							'prev_empmt_period_q',
							'incom_a',
							'bank_name_x',
							'acnt_type_desc_x',
							'bank_branch_name_x',
							'bank_acnt_n',
							'hmcu_insvy_y',
							'hmcu_rehab_d',
							'sellerbanknamex',
							'sellerbankaccn',
							'sellerbankbrchn',
							'sellerbankbrchnamex',
							'spouse_name_x',
							'spouse_id_n',
							'portion_share_p',
							'income_tax_n',
							'gross_incom_a',
							'gross_otime_a',
							'gross_subsy_a',
							'gross_comm_a',
							'rent_incom_a',
							'other_incom_a',
							'other_incom_desc_x',
							'total_incom_a',
							'pers_loan_inst_a',
							'motor_finc_instal_a',
							'mortg_instal_a',
							'rev_payment_a',
							'other_mnth_instal_a',
							'other_mnth_instal_desc_x',
							'other_rev_debt_desc_x',
							'total_living_exp_a',
							'total_expense_a',
							'group_scheme_name_x',
							'staff_acc_y',
							'gross_dividend_incom_a',
							'gross_interest_incom_a',
							'pers_loan_settled_y',
							'pers_loan_reduced_instalment_a',
							'motor_finc_settled_y',
							'motor_finc_reduced_instalment_a',
							'mortg_instal_settled_y',
							'mortg_instal_reduced_instalment_a',
							'other_rev_debt_settled_y',
							'other_rev_debt_reduced_instalment_a',
							'rev_payment_ave_outstanding_bal_a',
							'other_monthly_ave_outstanding_bal_a',
							'disposable_income_a',
							'bond_repayment_a',
							'nett_disposable_income_a',
							'other_monthly_instalments_a',
							'other_rev_debt_instal_a',
							'credit_card_payment_a',
							'credit_card_exposure_a',
							'storecard_mnth_ave_outstanding_bal_a',
							'email_add_x',
							'waiver_y',
							'gender',
							'ethnic_grp'
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
        
