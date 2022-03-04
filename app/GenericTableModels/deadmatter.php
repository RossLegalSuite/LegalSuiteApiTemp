<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class deadmatter extends Model
{
    protected $primaryKey = 'RecordId';

    protected $table = 'DeadMatter';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = true;

    protected $fillable = [
        'recordid',
        'matterid',
        'fileref',
        'description',
        'oldcode',
        'alternateref',
        'archiveno',
        'storagenumber',
        'storagedate',
        'storagelocation',
        'clientid',
        'employeeid',
        'mattertypeid',
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
