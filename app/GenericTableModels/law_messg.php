<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class law_messg extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'LAW_Messg';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'number',
							'message',
							'filter',
							'trandescriptionflag',
							'trandateflag',
							'tranreasonflag',
							'tranquantityflag',
							'tranaccountnameflag',
							'tranbanknameflag',
							'tranbranchcodeflag',
							'tranaccountnumberflag',
							'ftrandateflag',
							'ftrand_cflag',
							'ftranamountflag',
							'ftrantaxamountflag',
							'ftranamount_descriptionflag',
							'ftranaccountnumberflag',
							'ftrantenantnumberflag',
							'ftranrequiredflag',
							'instdatarequiredflag',
							'ftraninterestpercentageflag',
							'ftraninterestfromdateflag',
							'date_extended_fromflag',
							'date_extended_toflag',
							'freceipt_numberflag',
							'fdate_valid_fromflag',
							'fdate_valid_toflag',
							'descriptionhelp',
							'reasonhelp',
							'popupmessage',
							'sequenceno',
							'suiteid',
							'descautoheaderid',
							'reasonautoheaderid',
							'tranfuture_dateflag',
							'famountdescid',
							'fbanknameid',
							'autosendmessage1',
							'autosendsuite1',
							'autosendmessage2',
							'autosendsuite2',
							'autosendmessage3',
							'autosendsuite3',
							'autosendmessage4',
							'autosendsuite4',
							'autosendmessage5',
							'autosendsuite5',
							'autosendmessage6',
							'autosendsuite6',
							'autosendmessage7',
							'autosendsuite7',
							'autosendmessage8',
							'autosendsuite8',
							'autosendmessage9',
							'autosendsuite9',
							'autosendmessage10',
							'autosendsuite10',
							'active'
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
        
