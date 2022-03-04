<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class trademarkscreen extends Model
{

    protected $primaryKey = ['DocScreenID','TradeMarkID'];
    protected $table = 'TradeMarkScreen';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'trademarkid',
							'docscreenid',
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
							'field21',
							'field22',
							'field23',
							'field24',
							'field25',
							'field26',
							'field27',
							'field28',
							'field29',
							'field30'
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
        
