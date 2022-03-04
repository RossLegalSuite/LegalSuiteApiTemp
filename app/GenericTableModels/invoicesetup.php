<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class invoicesetup extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'InvoiceSetup';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = true;
    protected $fillable = [
							'recordid',
							'description',
							'location',
							'type',
							'xpos',
							'ypos',
							'width',
							'height',
							'alignment',
							'font',
							'fontsize',
							'boldflag',
							'underlineflag',
							'transparentflag',
							'italicflag',
							'englishvalue',
							'afrikaansvalue',
							'popupflag',
							'sorter'
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
        
