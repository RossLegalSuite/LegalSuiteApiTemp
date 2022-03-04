<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class rolescrn extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'RoleScrn';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'description',
							'field1',
							'field2',
							'field3',
							'field4',
							'field5',
							'field6',
							'field7',
							'field8',
							'field9',
							'field10',
							'field11',
							'field12',
							'field13',
							'field14',
							'field15',
							'field16',
							'field17',
							'field18',
							'field19',
							'field20',
							'field1help',
							'field2help',
							'field3help',
							'field4help',
							'field5help',
							'field6help',
							'field7help',
							'field8help',
							'field9help',
							'field10help',
							'field11help',
							'field12help',
							'field13help',
							'field14help',
							'field15help',
							'field16help',
							'field17help',
							'field18help',
							'field19help',
							'field20help',
							'field1type',
							'field2type',
							'field3type',
							'field4type',
							'field5type',
							'field6type',
							'field7type',
							'field8type',
							'field9type',
							'field10type',
							'field11type',
							'field12type',
							'field13type',
							'field14type',
							'field15type',
							'field16type',
							'field17type',
							'field18type',
							'field19type',
							'field20type',
							'field1calculation',
							'field2calculation',
							'field3calculation',
							'field4calculation',
							'field5calculation',
							'field6calculation',
							'field7calculation',
							'field8calculation',
							'field9calculation',
							'field10calculation',
							'field11calculation',
							'field12calculation',
							'field13calculation',
							'field14calculation',
							'field15calculation',
							'field16calculation',
							'field17calculation',
							'field18calculation',
							'field19calculation',
							'field20calculation',
							'field1requiredflag',
							'field2requiredflag',
							'field3requiredflag',
							'field4requiredflag',
							'field5requiredflag',
							'field6requiredflag',
							'field7requiredflag',
							'field8requiredflag',
							'field9requiredflag',
							'field10requiredflag',
							'field11requiredflag',
							'field12requiredflag',
							'field13requiredflag',
							'field14requiredflag',
							'field15requiredflag',
							'field16requiredflag',
							'field17requiredflag',
							'field18requiredflag',
							'field19requiredflag',
							'field20requiredflag'
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
        
