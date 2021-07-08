<?php

namespace App\Nova;

use App\Enums\AdTypeEnum;
use App\Nova\Metrics\ViewCount;
use App\Nova\Metrics\ViewsCountValue;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use SimpleSquid\Nova\Fields\Enum\Enum;

class AdvertisementBanner extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AdvertisementBanner::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $priority = 11;

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

            Text::make('Url'),

            Text::make('Views', function () {
                return views($this->model())->count();
            })->exceptOnForms(),

            DateTime::make('Started At'),
            DateTime::make('Ended At'),

            Images::make('Banner')->required(),

            Text::make('Note')
                ->rules('required', 'string', 'max:400'),

            Enum::make('Type')->attach(AdTypeEnum::class)
                ->rules('required', 'string'),

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
        return [
            new ViewCount,
            new ViewsCountValue
        ];
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

    public static function uriKey()
    {
        return 'ads';
    }

    public static function label()
    {
        return 'Reklaambännerid';
    }

    public static function singularLabel()
    {
        return 'Reklaambänner';
    }
}
