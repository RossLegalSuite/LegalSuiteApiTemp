<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ApiAccess extends Authenticatable
{
    use Notifiable;
    protected $table = 'api_access';
    protected $fillable = [
        'id', 'clientId', 'developerId', 'api_token', 'deleteAccessFlag', 'putAccessFlag', 'postAccessFlag','getAccessFlag','grantAccess'
    ];
}
