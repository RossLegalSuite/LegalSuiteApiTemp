<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class devprop extends Model
{
    protected $primaryKey = 'RecordID';

    protected $table = 'DevProp';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'recordid',
        'matterid',
        'sorter',
        'defaultsinsertedflag',
        'conditionclauseid',
        'conditionclauseflag',
        'shortdescription',
        'longpropline1',
        'longpropline2',
        'longpropline3',
        'longpropline4',
        'longpropline5',
        'heldby',
        'subjectto',
        'sectionnumber',
        'sectionplannumber',
        'buildingname',
        'situatedat',
        'localauthority',
        'extendingclause',
        'exclusiveuseareaflag',
        'extent',
        'units',
        'numberofareas',
        'languageid',
        'erfnumber',
        'portionnumber',
        'ratedeliverymethod',
        'rateapplicationdate',
        'elecwaternumber',
        'ratesaletype',
        'ratereason',
        'ratevaluationreq',
        'rateextra1',
        'rateextra2',
        'rateextra3',
        'rateassesmentrates',
        'ratevaliditydate',
        'rateaccountnumber',
        'deednumber',
        'localauthoritynumber',
        'ratesuburb',
        'elecacc',
        'wateracc',
        'weblinkbankref',
        'timeshareflag',
        'timesharephrase',
        'type_of_property',
        'prpty_type_x',
        'title_deed_number',
        'registration_number',
        'effective_app_d',
        'parent_property_desc_x',
        'scheme_name_x',
        'scheme_n',
        'unit_type',
        'managing_agent_x',
        'managing_agent_tel_n',
        'owned_existing_unit',
        'saleprice',
        'numerator',
        'denominator',
        'region_x',
        'developer_x',
        'total_num_erf',
        'grand_parent_erf_n',
        'app_ref_n',
        'parent_erf_n',
        'remainingextentflag',
        'lawref',
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
