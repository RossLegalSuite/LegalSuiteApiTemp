<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Language';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'description',
        'name',
        'physicalline1',
        'physicalline2',
        'physicalline3',
        'physicalline4',
        'physicalcode',
        'postalline1',
        'postalline2',
        'postalline3',
        'postalline4',
        'postalcode',
        'adminfeedescription',
        'collcommdescription',
        'agentdescription',
        'interestdescription',
        'drinvoicedescription',
        'crinvoicedescription',
        'invoicefeetotal',
        'actualdescription',
        'reserveddescription',
        'consolidateddescription',
        'feedescription',
        'disbursementdescription',
        'correspondentdescription',
        'receiptdescription',
        'paymentdescription',
        'journaldescription',
        'businesscreditordescription',
        'trusttransferdescription',
        'trustinvestmentdescription',
        'totalfees',
        'takeondescription',
        'bforwarddescription',
        'invoicereferencedescription',
        'currencysymbol',
        'currency1word',
        'currency1words',
        'currency2word',
        'currency2words',
        'invoiceheading1',
        'invoiceheading2',
        'invoiceleft',
        'invoicecentre',
        'invoiceright',
        'invoiceheading1size',
        'invoiceheading2size',
        'investmentfeedescription',
        'agreedfeedescription',
        'invoicefooter',
        'distributionfeedescription',
        'depreciationdescription',
        'postalcountryid',
        'physicalcountryid',
        'debtorcollcommdescription',
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
