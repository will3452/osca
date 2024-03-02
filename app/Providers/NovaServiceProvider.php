<?php

namespace App\Providers;

use Laravel\Nova\Nova;
use Laravel\Nova\Panel;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use App\Nova\Metrics\NewEvents;
use App\Nova\Metrics\NewMembers;
use App\Nova\Metrics\NewMessage;
use Laravel\Nova\Fields\Textarea;
use App\Nova\Metrics\NumberOfVisits;
use Illuminate\Support\Facades\Gate;
use Anaseqal\NovaSidebarIcons\NovaSidebarIcons;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        \OptimistDigital\NovaSettings\NovaSettings::addSettingsFields([
            Number::make('Maximum Login Attempt', 'max_log_attempt')->default(fn () => 5), 
            Panel::make('General Setting', [
                Image::make('Logo')
                ->help('After updating this setting field, please reload the page. use <b>CTRL + R</b> key combination to reload the entire page.')
            ]),
            Panel::make('Welcome Page Setting', [

                Image::make('Banner'),

                Textarea::make('Introduction', 'intro')
                ->help('After updating this setting field, please reload the page. use <b>CTRL + R</b> key combination to reload the entire page.'),

                Image::make('About Image'),

                Textarea::make('About Content', 'about_us'),

                Text::make('Footer', 'footer')
                ->help('After updating this setting field, please reload the page. use <b>CTRL + R</b> key combination to reload the entire page.'),
            ])

        ]);
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return true; 
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [
            new NewMembers(),
            new NewEvents(),
            new NumberOfVisits(),
            new NewMessage()
        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new NovaSidebarIcons(),
            (new \OptimistDigital\NovaSettings\NovaSettings)->canSee(function () {
                if (!auth()->user()) {
                    return false;
                }
                return is_null(auth()->user()->barangay);
            }),
            (new \Czemu\NovaCalendarTool\NovaCalendarTool)->canSee(function () {
                if (!auth()->user()) {
                    return false;
                }
                return is_null(auth()->user()->barangay);
            })
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
