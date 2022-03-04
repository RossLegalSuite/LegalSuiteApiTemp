<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

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
        'wordwrapcount',
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
