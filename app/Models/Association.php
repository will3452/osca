<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'officer_date_elected'=>'date'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
