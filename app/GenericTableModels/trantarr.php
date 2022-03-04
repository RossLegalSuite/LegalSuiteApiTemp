<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class trantarr extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'TranTarr';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'tariff',
							'age_basic',
							'age_break',
							'age1_break',
							'age2_break',
							'age_comm',
							'age1_comm',
							'age2_comm',
							'age_units',
							'age1_units',
							'age2_units',
							'props',
							'max1',
							'bond1',
							'max2',
							'bond2',
							'max3',
							'bond3',
							'max4',
							'bond4',
							'max5',
							'bond5',
							'max6',
							'bond6',
							'max7',
							'bond7',
							'max8',
							'bond8',
							'max9',
							'bond9',
							'max10',
							'bond10',
							'max11',
							'bond11',
							'max12',
							'bond12',
							'max13',
							'bond13',
							'max14',
							'bond14',
							'max15',
							'bond15',
							'max16',
							'bond16',
							'max17',
							'bond17',
							'max18',
							'bond18',
							'max19',
							'bond19',
							'max20',
							'bond20',
							'max21',
							'bond21',
							'max22',
							'bond22',
							'max23',
							'bond23',
							'max24',
							'bond24',
							'max25',
							'bond25',
							'max26',
							'bond26',
							'max27',
							'bond27',
							'max28',
							'bond28',
							'max29',
							'bond29',
							'max30',
							'bond30',
							'max31',
							'bond31',
							'max32',
							'bond32',
							'max33',
							'bond33',
							'break1',
							'unit1',
							'step1',
							'break2',
							'unit2',
							'step2',
							'break3',
							'unit3',
							'step3'
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
        
