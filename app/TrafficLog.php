<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TrafficLog extends Authenticatable
{
    use Notifiable;

    protected $table = 'trafficlog';

    protected $fillable = [
        'ip',
        'url',
        'method',
        'executionTime',
        'httpStatusCode',
        'clientId',
        'developerId',

    ];
}
