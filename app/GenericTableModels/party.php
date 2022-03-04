<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class party extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'Party';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'partytypeid',
        'name',
        'defaultlanguageid',
        'maritalstatus',
        'clientflag',
        'matterprefix',
        'incomeytd',
        'income1',
        'income2',
        'income3',
        'income4',
        'income5',
        'income6',
        'income7',
        'income8',
        'income9',
        'income10',
        'income11',
        'income12',
        'lincome1',
        'lincome2',
        'lincome3',
        'lincome4',
        'lincome5',
        'lincome6',
        'lincome7',
        'lincome8',
        'lincome9',
        'lincome10',
        'lincome11',
        'lincome12',
        'postingid',
        'batchid',
        'lineid',
        'transid',
        'oldcode',
        'useoldcodeflag',
        'consolidateflag',
        'consolidateid',
        'notes',
        'identitynumber',
        'notusedflag',
        'expenseytd',
        'expense1',
        'expense2',
        'expense3',
        'expense4',
        'expense5',
        'expense6',
        'expense7',
        'expense8',
        'expense9',
        'expense10',
        'expense11',
        'expense12',
        'lexpense1',
        'lexpense2',
        'lexpense3',
        'lexpense4',
        'lexpense5',
        'lexpense6',
        'lexpense7',
        'lexpense8',
        'lexpense9',
        'lexpense10',
        'lexpense11',
        'lexpense12',
        'extrascreenid',
        'physicalcountryid',
        'postalcountryid',
        'vatnumber',
        'parbankid',
        'billingmatterid',
        'weblinkbankref',
        'ficacompliantflag',
        'domiciliumflag',
        'taxnumber',
        'poanumber',
        'parregionid',
        'parcategoryid',
        'lawref',
        'spousetaxnumber',
        'laststageid',
        'lastcontactdate',
        'lastcontactdescription',
        'firstcontactdate',
        'mattertakeonreminder',
        'defaultroleid',
        'electronicpaymentflag',
        'entityid',
        'remoteaccesspassword',
        'remoteaccessexpiry',
        'birthday',
        'birthmonth',
        'birthdaysmsflag',
        'birthdaysmsmessage',
        'internalflag',
        'neverlolnotifyflag',
        'legalsuitefirmcode',
        'inactiveflag',
        'updatedbyid',
        'alternateref',
        'updatedbydate',
        'updatedbytime',
        'lawdeedid',
        'lawdeedbranchid',
        'donotnotifyflag',
        'lastinstructeddate',
        'deedsofficedoclogid',
        'taxpayer',
        'saresident',
        'annualincome',
        'passportnumber',
        'countryofresidence',
        'lastbirthdayeventdate',
        'auditorname',
        'auditorpostal',
        'auditorphysical',
        'auditorphone',
        'spousetaxpayer',
        'spousesaresident',
        'spouseannualincome',
        'spousepassportnumber',
        'spousecountryofresidence',
        'unmarriedstatus',
        'auditorfax',
        'ficarequestdate',
        'createdid',
        'createddate',
        'createdtime',
        'dateresolutionsigned',
        'auditorcontact',
        'auditoremail',
        'employername',
        'employerpostal',
        'employerphysical',
        'employerphone',
        'employerfax',
        'employercontact',
        'employeremail',
        'noficaflag',
        'identitydocumenttype',
        'lockparty',
        'signatoryid',
        'checksum',
        'docfoxid',
    ];

    public function setdateAttribute($value)
    {
        $this->attributes['date'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setcreateddateAttribute($value)
    {
        $this->attributes['createddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastcontactdateAttribute($value)
    {
        $this->attributes['lastcontactdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setfirstcontactdateAttribute($value)
    {
        $this->attributes['firstcontactdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setupdatedbydateAttribute($value)
    {
        $this->attributes['updatedbydate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastinstructeddateAttribute($value)
    {
        $this->attributes['lastinstructeddate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setlastbirthdayeventdateAttribute($value)
    {
        $this->attributes['lastbirthdayeventdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setficarequestdateAttribute($value)
    {
        $this->attributes['ficarequestdate'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setdateresolutionsignedAttribute($value)
    {
        $this->attributes['dateresolutionsigned'] = $value ? (string) ModelHelper::convertClarionDate($value) : '';
    }

    public function setupdatedbytimeAttribute($value)
    {
        $this->attributes['updatedbytime'] = $value ? (string) ModelHelper::convertClarionTime($value) : '';
    }

    public function setcreatedtimeAttribute($value)
    {
        $this->attributes['createdtime'] = $value ? (string) ModelHelper::convertClarionTime($value) : '';
    }
}
