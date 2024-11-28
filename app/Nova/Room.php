<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Khalin\Nova\Field\Link;
use Laravel\Nova\Fields\BelongsTo;

class Room extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Room::class;

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

    public static $priority = 6;

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

            Text::make('Name')
                ->rules('required', 'string'),


            Text::make('Square meters')
                ->rules('nullable', 'string'),

            Text::make('Theatre style capacity')
                ->rules('nullable', 'string'),

            Text::make('Classroom style capacity')
                ->rules('nullable', 'string'),

            Text::make('Diplomatic style capacity')
                ->rules('nullable', 'string'),

            Text::make('U shaped capacity')
                ->rules('nullable', 'string'),

            Text::make('Inauguration style capacity')
                ->rules('nullable', 'string'),

            Text::make('Cabaret style capacity')
                ->rules('nullable', 'string'),

            Link::make('Url')->rules('nullable', 'url'),

            BelongsTo::make('Property'),
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

    public static function label() {
        return 'Ruumid';
    }

    public static function singularLabel() {
        return 'Ruum';
    }
}
