<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ApiTrafficLog extends Authenticatable
{
    use Notifiable;
    protected $table = 'apitrafficlog';
    protected $fillable = [
        "ip",
        "fullUrl",
        "url",
        "path",
        "method",
        "executionTime",
        "getStatusCode",
        "companyId",
        "companyName",
        "appId",
        "parameters",
        "userAgent",
        "header",
    ];
}
