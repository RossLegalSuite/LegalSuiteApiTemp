<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_tier extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_Tier';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'matterid',
							'number',
							'tier_a',
							'tier_rate_p',
							'tier_term_months_q',
							'tier_instal_a',
							'cncsnratep',
							'riskratep'
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
        
