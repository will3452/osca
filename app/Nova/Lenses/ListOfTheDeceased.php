<?php

namespace App\Nova\Lenses;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\LensRequest;

class ListOfTheDeceased extends Lens
{
    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->whereNotNull('died_at'),
        ));
    }

    /**
     * Get the fields available to the lens.
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

                        Text::make('Occupation')
                            ->hideFromIndex(),

                        Text::make('Position')
                            ->hideFromIndex(),

                        Date::make('Died At'),
                    ]),

                    Tab::make('Address', [
                        Text::make('House No.', 'house_no'),

                        Text::make('Street')
                            ->rules(['required']),

                        Select::make('Barangay')
                            ->options(is_null(auth()->user()->barangay) ?
                            \App\Models\Barangay::get()->pluck('name', 'name') :
                            \App\Models\Barangay::where('name', auth()->user()->barangay)->get()->pluck('name', 'name'))
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
     * Get the cards available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return parent::actions($request);
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'list-of-the-deceased';
    }
}
