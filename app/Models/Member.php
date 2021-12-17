<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    protected static $logAttributes = [
        'picture',
        'reference_number',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'place_of_birth',
        'house_no',
        'street',
        'barangay',
        'occupation',
        'position',
        'date_of_membership',
        'contact_number'
    ];

    protected $casts = [
        'date_of_membership'=>'date',
        'birthdate'=>'date',
        'died_at' => 'date',
    ];

    public function getUrlAttribute()
    {
        return route('member.show', ['member'=>$this]);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }

    public function associations()
    {
        return $this->hasMany(Association::class);
    }

    public function getMobileAttribute()
    {
        return "63" . $this->contact_number;
    }
}
