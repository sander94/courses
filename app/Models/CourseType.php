<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;

class CourseType extends Model
{
    protected $fillable = [
        'title',
        'show_on_search_page'
    ];

    public function courses(): BelongsTo
    {
        return $this->hasMany(Course::class);
    }
}
