<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Laravel\Nova\Http\Requests\NovaRequest;
use Bolechen\NovaActivitylog\Resources\Activitylog;

class AuditTrail extends Activitylog
{
    public static $displayInNavigation = true;

    public static function label()
    {
        return 'Audit Trail';
    }

    public static function icon()
    {
        return view('nova::svg.trail')->render();
    }

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = Activity::class;
}
