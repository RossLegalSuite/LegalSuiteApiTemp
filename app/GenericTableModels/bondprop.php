<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class bondprop extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'BondProp';
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
							'deedsofficedoclogid',
							'levystartdate',
							'levysplitdate',
							'levyenddate',
							'ratesstartdate',
							'ratessplitdate',
							'ratesenddate',
							'levyamount',
							'levybuyeramount',
							'levyselleramount',
							'ratesamount',
							'ratesbuyeramount',
							'ratesselleramount',
							'speciallevy1',
							'speciallevy1buyerseller',
							'speciallevy2',
							'speciallevy2buyerseller',
							'arrearlevies',
							'hoaarrears',
							'hoacertificate',
							'occupationtargetdate',
							'occupationactualdate',
							'occupationamount',
							'occupationbuyeramount',
							'occupationselleramount',
							'hoalevy',
							'arrearrates',
							'municipalarrears',
							'absa_city',
							'absa_township',
							'absa_erfno',
							'absa_portion',
							'streetaddress',
							'erfno',
							'korbitecmsgidref',
							'ratesbondpropstate',
							'linkedmatterid',
							'ratesendorsementtype',
							'ratesfarmnumber',
							'ratesregistrationdivision',
							'ratesschemeyear',
							'ratesunitnumber',
							'ratesrequesttype',
							'transfereuaonly',
							'rateslowcosthousingflag',
							'listname',
							'draftrequestid',
							'act66flag',
							'townshipid',
							'ratescertificatedownloadedflag',
							'requirementcodes',
							'newimposedconditionclauseid',
							'newimposedconditionclauseflag'
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
        
