<?php

namespace App\Nova;

use App\Nova\Actions\DuplicateCourse;
use App\Nova\Actions\DuplicateResource;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;

class Course extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Course::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title'
    ];

    public static $priority = 3;

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

            Text::make('Title')
                ->rules('required', 'string', 'max:400'),

            DateTime::make('Featuring ended at')->nullable()->hideFromIndex(),

            /* Number::make('Duration Minutes')
                 ->rules('integer'), */

            Text::make('Clicks Count', function () {
                return views($this->model())->count();
            })->exceptOnForms(),

            BelongsToManyField::make('Course Category', 'courseCategories', CourseCategory::class)->rules([
                'required'
            ])->required()->hideFromIndex(),

            Text::make('Price')
                ->rules('required')->hideFromIndex(),

            Text::make('Url')->hideFromIndex(),

            Date::make('Started At')->nullable(),
            Date::make('Ended At')->hideFromIndex()->nullable(),

            BelongsToMany::make('Course Category', 'courseCategories')->hideFromIndex(),

            BelongsTo::make('Region', 'region')
                ->searchable()
                ->prepopulate()->hideFromIndex(),

            BelongsTo::make('Company')
                ->searchable()
                ->prepopulate(),


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
        return [
            new DuplicateCourse
        ];
    }

    public static function label()
    {
        return 'Koolitused';
    }

    public static function singularLabel()
    {
        return 'Koolitus';
    }
}
