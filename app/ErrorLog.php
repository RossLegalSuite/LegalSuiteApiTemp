<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ErrorLog extends Authenticatable
{
    use Notifiable;
    protected $table = 'errorlog';
    protected $fillable = [
                "ip",
                "application",
                "url",
                "method",
                "parameters",
                "clientId",
                "developerId",
                "message",
                "file",
                "line"

    ];
}
