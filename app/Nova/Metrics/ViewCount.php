<?php

namespace App\Nova\Metrics;

use App\Models\Company;
use Cake\Chronos\Chronos;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendDateExpressionFactory;
use Laravel\Nova\Metrics\TrendResult;
use Laravel\Nova\Nova;

class ViewCount extends Trend
{

    /**
     * @var bool
     */
    public $onlyOnDetail = true;

    /**
     * Calculate the value of the metric.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        /** @var Model $model */
        $model = $request->findResourceOrFail();

        return $this->countByDays($request, View::query()
            ->where('viewable_type', $model->getMorphClass())
            ->where('viewable_id', $model->getKey()),
            'viewed_at');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            30 => __('30 Days'),
            60 => __('60 Days'),
            90 => __('90 Days'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'view-count';
    }
}
