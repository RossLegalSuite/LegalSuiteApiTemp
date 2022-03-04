<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class nedinst extends Model
{

    protected $primaryKey = 'RecordId';
    protected $table = 'NedInst';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'hnhl',
							'description',
							'languageid',
							'matterid',
							'exportedon',
							'mortsigneddt',
							'docssentdt',
							'lodgedt',
							'prepdt',
							'regdt',
							'mortsignedflag',
							'docssentflag',
							'lodgeflag',
							'prepflag',
							'regflag',
							'appstatus',
							'nhl_appversion',
							'neddivision',
							'apprecvd',
							'archivedate',
							'apptype',
							'appntype',
							'applang',
							'codocs',
							'coreptitle',
							'coname',
							'coreg',
							'coregdt',
							'coofficers',
							'cophone',
							'cocontact',
							'apptitle',
							'appsurname',
							'appfirstnames',
							'appid',
							'appdob',
							'appmaritalstatus',
							'appphh',
							'appphw',
							'coq',
							'coapptitle',
							'coappsurname',
							'coappfirstnames',
							'coappid',
							'coappdob',
							'coappmaritalstatus',
							'coappphh',
							'coappphw',
							'comoreq',
							'appaddressee',
							'apppoaddr',
							'apppocode',
							'appfuturepoaddr',
							'appfuturepocode',
							'futureaddrdt',
							'lnpurpose',
							'bldq',
							'lnpurchprice',
							'lnpassedby',
							'faballoan',
							'facurrentbond',
							'faaddnloan',
							'faloansumq',
							'faloansum',
							'lnpassedby1',
							'devloanq',
							'bldq1',
							'lncoschemeq',
							'lncoscheme',
							'lncoschemeguarq',
							'lnconsentreceivedq',
							'lncoschemeguar',
							'lncoschemeguaramt',
							'lncoschemesalstoporderq',
							'lncoscheme2loansq',
							'lnlifeassq',
							'lnlifeass',
							'lnnamesassd',
							'lalifepremium',
							'lnsumassd',
							'lnlifeapprecvdq',
							'lnprd',
							'lnnedrevholder',
							'lnnedrevno',
							'lnunittrustq',
							'lnut',
							'lnutoption',
							'lnutlumpsum',
							'lnutmonthly',
							'blddocs',
							'bldcompletiondt',
							'prptype',
							'prpstandno',
							'prpsuburb',
							'prpstreet',
							'prpstreetno',
							'prpfreelease',
							'prpstq',
							'prpstunit',
							'prpstflatno',
							'prpseller',
							'prptrfatty',
							'colq',
							'coltype',
							'coltypea',
							'colname',
							'colamt',
							'coltype2',
							'coltype2a',
							'colname2',
							'colamt2',
							'coltype3',
							'coltype3a',
							'colname3',
							'colamt3',
							'colobtainedby',
							'bndbondholder',
							'bndbranch',
							'bndaccno',
							'bndclient',
							'genagentq',
							'genintroagent',
							'genintroagentcode',
							'oldmutualq',
							'prbq',
							'prbcontact',
							'genbranch',
							'genbranchno',
							'genbranchph',
							'genbranchfax',
							'laaccno',
							'lagrantdt',
							'laloanamt',
							'lnbondamt',
							'lavalnamt',
							'laretentionamt',
							'laretention',
							'lnmonths',
							'laintrate',
							'lafixedrateq',
							'lafixedrate',
							'lafixedratemonths',
							'laratetype',
							'laratetypea',
							'larateadj',
							'larateadjperiod',
							'laspecialrateadj',
							'lanetintrate',
							'lahostrate',
							'fahocinsamt',
							'fahoccededq',
							'fahocreqdq',
							'laprdtype',
							'laaccstatus',
							'labondatty',
							'labondattyaddr',
							'labondattyph',
							'labondattyenc',
							'labondattycode',
							'laballoan',
							'lanpoamt',
							'latot1',
							'lareadvance',
							'lafurtherloan',
							'latot2',
							'latot3',
							'latot4',
							'larepayamt',
							'larepaytot',
							'laintoptq',
							'laintmonths',
							'lafinancecharge',
							'ladebitorderq',
							'laarchitectq',
							'labldretentionamt',
							'lablddocsreqd',
							'col3rdpartybondq',
							'col3rdparty',
							'col3rdpartyamt',
							'lacancel3rdpartybondq',
							'larepay3rdpartybondq',
							'waive3rdpartyprefq',
							'regcostsexloanq',
							'releasecolsecurityq',
							'releasecolsecurityname',
							'trfexistingpropq',
							'lapestq',
							'lawiringq',
							'lafeesatty',
							'labankpaycostsq',
							'labankpaycosts',
							'lahocpremium',
							'lalifepremium1',
							'lafeesinit',
							'lafeesvaln',
							'lafeesadmin',
							'lafeesatty1',
							'lacollectfeesatty',
							'lasurety',
							'bondbysuretyq',
							'suretyname',
							'suretyamt',
							'suretyrnk',
							'suretyprop',
							'colbondq',
							'colbondrnk',
							'colbondprop',
							'laschemecode',
							'ntudt',
							'ladevconditions',
							'notes',
							'labondattynotes',
							'instrrecvdt'
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
        
