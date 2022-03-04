<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;


class lolclientreport extends Model
{

    protected $connection = 'sqlsrv';
    protected $table = 'LolClientReport';
    public $timestamps = false;
    protected $primaryKey = 'recordid';
    public $incrementing = true;
    public $uniqueColumns = ['title'];    
    protected $guarded = ['recordid'];

}
        
