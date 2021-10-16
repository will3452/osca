<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    protected $table = 'events';

    use LogsActivity;

    protected static $logAttributes = [
        'start',
        'end',
        'title'
    ];

    protected $casts = [
        'start'=>'datetime',
        'end'=>'datetime',
    ];
}
