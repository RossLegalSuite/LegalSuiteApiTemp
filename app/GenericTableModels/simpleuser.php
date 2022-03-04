<?php

namespace App\GenericTableModels;

use App\Custom\ModelHelper;
use Illuminate\Database\Eloquent\Model;

class simpleuser extends Model
{
    protected $primaryKey = 'Oid';

    protected $table = 'SimpleUser';

    protected $connection = 'sqlsrv';

    public $timestamps = false;

    public $incrementing = false;

    protected $fillable = [
        'oid',
        'username',
        'fullname',
        'isactive',
        'isadministrator',
        'changepasswordonfirstlogon',
        'password',
        'optimisticlockfield',
        'gcrecord',
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
