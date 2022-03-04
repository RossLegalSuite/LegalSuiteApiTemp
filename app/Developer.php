<?php

namespace App;

// use Illuminate\Foundation\Auth\User as Authenticatable;
// use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Developer extends Authenticatable
{
    use Notifiable;

    protected $guarded = ['developer'];

    // protected $hidden = [
    //     'password'
    // ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    protected $fillable = [
        'id', 'company_name', 'name', 'email', 'email_verified_at', 'password', 'developer_token', 'isNotActive', 'deleteAccessFlag', 'putAccessFlag', 'postAccessFlag', 'getAccessFlag',
    ];
}
