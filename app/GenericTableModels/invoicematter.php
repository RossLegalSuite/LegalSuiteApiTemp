<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class invoicematter extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'InvoiceMatter';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'invoiceno',
        'consolidateid',
        'matterid',
        'lastinvoiceno',
        'lastinvoiceactual',
        'lastinvoicereserved',
        'lastinvoiceinvested',
        'thisinvoiceactual',
        'thisinvoicereserved',
        'thisinvoiceinvested',
        'actual',
        'reserved',
        'invested',
        'agecurrent',
        'age30day',
        'age60day',
        'age90day',
        'age120day',
        'age150day',
        'age180day',
        'startbatchid',
        'endbatchid',
        'type',
        'year',
        'period',
        'date',
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
