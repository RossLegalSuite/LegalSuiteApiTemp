<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;

class lolcomponent extends Model
{
    protected $connection = 'sqlsrv';

    protected $table = 'LolComponent';

    public $timestamps = false;

    protected $primaryKey = 'recordid';

    public $incrementing = true;

    public $uniqueColumns = ['title'];

    protected $guarded = ['recordid'];
    // protected $fillable = [
    //     'source',
    //     'title',
    //     'description',
    //     'contents',
    // ];
}
