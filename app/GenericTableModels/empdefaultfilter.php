<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class empdefaultfilter extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'EmpDefaultFilter';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'employeeid',
        'filtermattertypeid',
        'filtermattertypeflag',
        'filtercostcentreflag',
        'filtergroupflag',
        'filtercostcentreid',
        'filtergroupid',
        'filteremployeeflag',
        'filterdateflag',
        'filterfromdate',
        'filtertodate',
        'filterdocgenflag',
        'filterdocgenid',
        'filtersheriffareaflag',
        'filtersheriffareaid',
        'filteremployeeid',
        'filtermattersby',
        'filterbalances',
        'filteraging',
        'filterfavouritesflag',
        'filterdebtlinkflag',
        'filterdebtlinkcategory',
        'filterstatusarchiveflag',
        'filterstatuspendingflag',
        'filterstatusliveflag',
        'filterlaststageflag',
        'filterstageid',
        'filterpargroupflag',
        'filterpargroupid',
        'filterparregionflag',
        'filterparcategoryflag',
        'filterparanystageflag',
        'filterparlaststageflag',
        'filterparregionid',
        'filterparcategoryid',
        'filterparanystageid',
        'filterparlaststageid',
        'filterstageflag',
        'filterbranchflag',
        'filterbranchid',
        'filterdateoption',
        'filterconveyancingstatus',
        'filterconveyancingstatusflag',
        'restricttoclientlist',
        'restricttobranchlist',
        'restricttoemployeelist',
        'restricttodocgenlist',
        'restricttomattertypelist',
        'restricttocostcentrelist',
        'filterstagesinlistflag',
        'filterstagesnotinlistflag',
        'restricttocriticalsteplist',
        'filtercriticalstepsnotinlistflag',
        'filtercriticalstepsnotinlist',
        'filtercriticalstepsinlistflag',
        'filterinactivemattersflag',
        'filterinactivedays',
        'filterinactivefilenotesflag',
        'filterfilenotesoption',
        'filterinactivefeenotesflag',
        'filterinactivetodonotesflag',
        'filterinactivecoldebitflag',
        'filterinactivemattranflag',
        'recordid',
        'description',
        'filterlastinvoicedate',
        'filterpartyroleflag',
        'filterparty1id',
        'filterrole1id',
        'filterparty2id',
        'filterrole2id',
        'filterparty3id',
        'filterrole3id',
        'filterstagesinlist',
        'filterstagesnotinlist',
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
