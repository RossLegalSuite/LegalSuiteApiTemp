<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;
use App\Custom\ModelHelper;

class reptotal extends Model
{

    protected $primaryKey = 'RecordID';
    protected $table = 'RepTotal';
    protected $connection = 'sqlsrv';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
							'recordid',
							'reportid',
							'type',
							'sorter',
							'inrow',
							'incolumn',
							'contentoption',
							'contents',
							'skipblankflag',
							'calculationoption',
							'totalcolumn',
							'functionoption',
							'tocol',
							'fromcol',
							'fromrow',
							'torow',
							'saveresultflag',
							'saveresultvariable',
							'specificfontflag',
							'fontname',
							'fontsize',
							'fontbold',
							'fontunderline',
							'fontitalic',
							'alignh',
							'alignv',
							'wordwrap',
							'formattype',
							'formatstring',
							'borderoutline',
							'bordertop',
							'borderbottom',
							'borderleft',
							'borderright',
							'pattern',
							'patternforeground',
							'patternbackground',
							'printconditionflag',
							'printcondition',
							'pagebreak',
							'columnheadingoption',
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
        
