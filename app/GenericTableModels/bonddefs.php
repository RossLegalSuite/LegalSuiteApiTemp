<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class bonddefs extends Model
{
    protected $primaryKey = ['EmployeeID', 'LanguageID'];

    protected $table = 'BondDefs';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'employeeid',
        'languageid',
        'registrar',
        'pagrantedat',
        'documentssignedat',
        'conveyancerfirstnames',
        'agent',
        'extendingclause',
        'commissioner',
        'notary',
        'conveyancerinitials',
        'conveyancerlastname',
        'heldby',
        'buildingname',
        'subjectto',
        'localauthority',
        'agentflag',
        'lodgingagentid',
        'appearerpoa',
        'appearerdeed',
        'commissionerdesignation',
        'discountoption',
        'discountdisplayflag',
        'receiverid',
        'localauthorityid',
        'waterauthorityid',
        'units',
        'proformaheading',
        'deedsofficeid',
        'letterhead',
        'addressinletterheadflag',
        'lodgingagentparalegalid',
        'bankdetailsonaccountflag',
        'notaryprovince',
        'docgenid',
        'appearerpoaid',
        'appearerdeedid',
        'conveyancerpracticeno',
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
