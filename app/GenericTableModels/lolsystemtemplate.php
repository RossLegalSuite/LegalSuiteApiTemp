<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;


class lolsystemtemplate extends Model
{

    protected $connection = 'sqlsrv';
    protected $table = 'LolSystemTemplate';
    public $timestamps = false;
    protected $primaryKey = 'recordid';
    public $incrementing = true;
    public $uniqueColumns = ['title'];    
    protected $guarded = ['recordid'];
    // protected $fillable = [
    //     'source',
    //     'type',
    //     'roleid',
    //     'title',
    //     'description',
    //     'contents',
    //     'footer',
    //     'header',
    //     'orientation',
    //     'papersize',
    //     'password',
    //     'allowprint',
    //     'allowedit',
    //     'allowcopy',
    //     'bottommargin',
    //     'topmargin',
    //     'leftmargin',
    //     'rightmargin',
    // ];


}
        
