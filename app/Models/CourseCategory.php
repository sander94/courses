<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'is_buyable',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_buyable' => 'boolean',
    ];


    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'course_category_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'course_category_id');
    }
}
