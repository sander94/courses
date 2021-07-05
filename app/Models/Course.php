<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Spatie\EloquentSortable\SortableTrait;

class Course extends Model implements Viewable
{
    use HasFactory, SortableTrait, InteractsWithViews, Sluggable;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => false,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'featuring_ended_at',
        'duration_minutes',
        'price',
        'course_category_id',
        'region_id',
        'started_at',
        'ended_at',
        'url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'featuring_ended_at' => 'datetime',
    ];

    protected $dates = [
        'started_at',
        'ended_at'
    ];

    public function courseCategories(): BelongsToMany
    {
        return $this->belongsToMany(CourseCategory::class, 'category_course');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeFeaturedOrder($query)
    {
        return $query
            ->addSelect(DB::raw(
                "IF(featuring_ended_at IS NULL,NOW(),featuring_ended_at) as order_column,
                IF(started_at IS NULL, '2079-06-05T23:59:00', started_at) as started_at,
                `courses`.*")
            )
            ->orderBy('order_column', 'DESC')
            ->orderBy('started_at', 'ASC');
    }
}
