<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Nova\Fields\BelongsTo;

class CourseType extends Model
{
    protected $fillable = [
        'title',
        'show_on_search_page'
    ];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
