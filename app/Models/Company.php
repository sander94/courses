<?php

namespace App\Models;

use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Company extends Authenticatable implements HasMedia, Viewable
{
    use HasFactory, InteractsWithMedia, InteractsWithViews;

    protected $fillable = [
        'name',
        'brand',
        'phone',
        'description',
        'website',
        'reg_number',
        'city',
        'street',
        'postal',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile();
    }
}
