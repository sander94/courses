<?php

namespace App\Nova;

use App\Nova\Metrics\ViewCount;
use Benjacho\BelongsToManyField\BelongsToManyField;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Ek0519\Quilljs\Quilljs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use OptimistDigital\NovaSortable\Traits\HasSortableRows;

/**
 * Class Company
 * @package App\Nova
 * @mixin \App\Models\Company
 */
class Company extends Resource
{
    use HasSortableRows;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Company::class;

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

    public static $priority = 1;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Number::make(__('Sort Order'), 'sort_order'),

            Text::make('Facebook Url')
                ->rules([
                    'nullable',
                    'string',
                    'url'
                ])->hideFromIndex(),

            Text::make('Clicks Count', function () {
                return views($this->model())->count();
            })->exceptOnForms(),

            Password::make(__('Password'), 'password')->hideFromIndex(),

            Text::make(__('Name'), 'name')->required(),

            Text::make(__('Email'), 'email')->required(),

            Quilljs::make(__('Description'), 'description')
                ->paddingBottom(30)
                ->withFiles('public')
                ->height(650)
                ->rules('required'),

            Text::make(__('Brand'), 'brand')->required()->hideFromIndex(),

            BelongsTo::make(__('Region'), 'region')->required()->hideFromIndex(),

            Images::make(__('Cover'), 'cover')->hideFromIndex(),

            Text::make(__('Reg Number'), 'reg_number')->hideFromIndex(),

            Text::make(__('Phone'), 'phone')->hideFromIndex(),
            Text::make(__('City'), 'city')->hideFromIndex(),
            Text::make(__('Street'), 'street')->hideFromIndex(),
            Text::make(__('Postal'), 'postal')->hideFromIndex(),
            Text::make(__('Website'), 'website')->hideFromIndex(),

            BelongsToManyField::make('Tags')->hideFromIndex(),

            HasMany::make('Courses')

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
     /*   return [
            new ViewCount
        ]; */
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
        return 'Ettevõtted';
    }

    public static function singularLabel()
    {
        return 'Ettevõte';
    }
}
