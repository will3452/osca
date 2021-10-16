<?php

namespace App\Observers;

use App\Models\Member;
use Illuminate\Support\Str;

class MemberObserver
{
    public function creating(Member $member)
    {
        $member->date_of_membership = now();
    }

    public function created(Member $member)
    {
        $reference_number = Str::padLeft("$member->id", 8, '0');
        $member->update([
            'reference_number'=>$reference_number,
        ]);
    }
}
