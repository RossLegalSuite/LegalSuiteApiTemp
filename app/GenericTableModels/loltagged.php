<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;

class loltagged extends Model
{
    protected $connection = 'sqlsrv';

    protected $table = 'LolTagged';

    public $timestamps = false;

    protected $primaryKey = ['tableName', 'employeeId', 'taggedId'];

    public $incrementing = false;

    protected $fillable = [
        'tableName',
        'employeeId',
        'taggedId',
    ];
}
