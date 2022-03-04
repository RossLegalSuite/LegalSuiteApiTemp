<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class repcol extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'RepCol';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'reportid',
							'sorter',
							'fieldtype',
							'variableid',
							'fieldid',
							'customfield',
							'heading',
							'autofitflag',
							'columnwidth',
							'specificfontflag',
							'fontname',
							'fontsize',
							'fontbold',
							'fontunderline',
							'fontitalic',
							'alignh',
							'alignv',
							'wordwrap',
							'borderoutline',
							'formattype',
							'formatstring',
							'bordertop',
							'borderbottom',
							'borderleft',
							'borderright',
							'pattern',
							'patternforeground',
							'patternbackground',
							'sortflag',
							'sortlevel',
							'sortorder',
							'saveresultflag',
							'saveresultvariable',
							'saveresultconditionflag',
							'saveresultcondition',
							'insertcolumncondition',
							'displaycolumncondition',
							'wordwrapcount'
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
        
