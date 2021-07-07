<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;

class Property extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Property::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
    ];

    public static $priority = 8;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Images::make(__('Cover'), 'cover'),

            Images::make(__('Gallery'), 'gallery')->hideFromIndex(),

            Text::make('Name')
                ->rules('required', 'string'),

            Text::make('Company name')
                ->rules('required', 'string'),

            Text::make('Address')
                ->rules('required', 'string')->hideFromIndex(),

            Text::make('Url')
                ->rules('nullable', 'url')->hideFromIndex(),

            Text::make('Facebook Url')
                ->rules('nullable', 'url')->hideFromIndex(),

            Text::make('Phone')
                ->rules('nullable', 'string')->hideFromIndex(),

            Text::make('Email')
                ->rules('required', 'email'),

            BelongsTo::make('Property Region', 'propertyRegion'),

            HasMany::make('Rooms'),

            BelongsToMany::make('Services', 'services', ExtraService::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    public static function label()
    {
        return 'Ruumid - koolituskeskused';
    }

    public static function singularLabel()
    {
        return 'Koolituskeskus';
    }
}
