<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ForApproval extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $guarded = [];

    protected $table = 'members';

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
        'contact_number',
        'died_at',
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('living', function (Builder $builder) {
            $builder->whereStatus(Member::STATUS_PENDING);
        });
    }
}
