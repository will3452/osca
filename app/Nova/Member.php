<?php

namespace App\Nova;

use App\Nova\Actions\GenerateID;
use App\Nova\Actions\GenerateReport;
use App\Nova\Actions\MarkAsDeath;
use App\Nova\Actions\sendSmsMessage;
use App\Nova\Actions\ViewOrDownloadQrCode;
use App\Nova\Filters\BarangayFilter;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Member extends Resource
{
    public static function indexQuery(NovaRequest $request, $query)
    {
        if (is_null(auth()->user()->barangay)) {
            return $query->whereStatus(\App\Models\Member::STATUS_ACTIVE);
        }
        return $query->whereStatus(\App\Models\Member::STATUS_ACTIVE)->where('barangay', auth()->user()->barangay);
    }

    public static function label()
    {
        return 'Member Records';
    }

    public static function icon()
    {
        // Assuming you have a blade file containing an image
        // in resources/views/vendor/nova/svg/icon-user.blade.php
        return view('nova::svg.icon-user')->render();
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Member::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return "$this->reference_number - $this->first_name $this->last_name";
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'reference_number',
        'first_name',
        'last_name',
        'middle_name',
        'Barangay',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Tabs::make('Member Information', [
                Tab::make('Basic', [
                    Image::make('Picture')
                        ->help('2 x 2 picture with white background'),

                    Text::make('First Name')
                        ->rules(['required']),

                    Text::make('Middle Name')
                        ->rules(['required']),

                    Text::make('Last Name')
                        ->rules(['required']),

                    Date::make('Birthdate')
                        ->rules('required')->hideFromIndex(),

                    Text::make('Place Of Birth')
                        ->rules(['required'])->hideFromIndex(),

                    Text::make('Mobile No.', 'mobile')
                        ->exceptOnForms(),

                    Text::make('Contact Number')
                        ->onlyOnForms()
                        ->required(),

                    Text::make('Occupation')
                        ->hideFromIndex(),

                    Text::make('Position')
                        ->hideFromIndex(),
                ]),

                Tab::make('Address', [
                    Text::make('House No.', 'house_no'),

                    Text::make('Street')
                        ->rules(['required']),

                    Select::make('Barangay')
                        ->options(is_null(auth()->user()->barangay) ?
                            \App\Models\Barangay::get()->pluck('name', 'name') :
                            \App\Models\Barangay::where('name', auth()->user()->barangay)->get()->pluck('name', 'name')),
                ]),

                Tab::make('Account', [
                    Text::make('Reference Number')
                        ->exceptOnForms(),
                    Date::make('Date Of Membership')
                        ->exceptOnForms(),
                ]),

                Tab::make('Family', [
                    HasMany::make('Family', 'families'),
                ]),

                Tab::make('Assocations', [
                    HasMany::make('Associations'),
                ]),

            ])
                ->withToolbar(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            BarangayFilter::make(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [

        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            ViewOrDownloadQrCode::make()
                ->onlyOnDetail(),
            (new GenerateReport)->standalone(),
            new DownloadExcel,
            (new GenerateID()),
            new MarkAsDeath(),
            new sendSmsMessage(),
        ];
    }
}
