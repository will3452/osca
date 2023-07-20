<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Event extends Model
{
    protected $table = 'events';

    use LogsActivity;

    protected static $logAttributes = [
        'start',
        'end',
        'title',
        'venue',
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}
