<?php

namespace App\GenericTableModels;

use Illuminate\Database\Eloquent\Model;


class lolsettings extends Model
{

    protected $connection = 'sqlsrv';
    protected $table = 'LolSettings';
    public $timestamps = false;
    protected $primaryKey = 'recordid';
    public $incrementing = true;
    protected $guarded = ['recordid'];
    // protected $fillable = [
    //     'website',
    //     'logo',
    //     'letterheadpdffile',
    //     'letterheadfilename',
    //     'smtpserver',
    //     'smtpport',
    //     'smtpencryption',
    //     'smtpauthentication',
    //     'incomingserver',
    //     'incomingport',
    //     'incomingencryption',
    // ];


}
        
