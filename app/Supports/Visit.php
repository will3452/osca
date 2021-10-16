<?php

namespace App\Supports;

use App\Models\Visit as ModelsVisit;

class Visit
{
    public static function init($ip)
    {
        if (self::isVisitedToday($ip)) {
            return;
        }

        ModelsVisit::create([
            'visitor_ip'=>$ip,
        ]);
    }

    public static function isVisitedToday($ip)
    {
        $isVisit = ModelsVisit::whereDate('created_at', today())->where('visitor_ip', $ip)->get();

        return count($isVisit) != 0;
    }

    public static function currentNumberOfVisitToday()
    {
        return ModelsVisit::whereDate('created_at', today())->count();
    }
}
