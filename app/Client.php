<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable
{
    use Notifiable;
    protected $guarded = ['web'];
    /**
    * The attributes that are mass assignable.
    * protected $guarded = ['developer'];
    * @var array
    */ protected $fillable = [
        'company_name','firmcode','name','email','website','password', 'dbHost', 'dbPort', 'dbDatabase', 'dbUser', 'dbPassword'
    ];
    // protected $fillable = [
        //     'name', 'email', 'password', 'company_name',
        // ];
        
        /**
        * The attributes that should be hidden for arrays.
        *
        * @var array
        */
        protected $hidden = [
            'password', 'remember_token',
        ];
        
        /**
        * The attributes that should be cast to native types.
        *
        * @var array
        */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];
    }
    