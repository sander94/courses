<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\BelongsTo;

class CourseType extends Model
{
    protected $fillable = [
        'title'
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
