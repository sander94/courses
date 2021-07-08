<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\EloquentSortable\SortableTrait;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SortableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

        public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'name',
        'company_name',
        'address',
        'url',
        'email',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function propertyRegion()
    {
        return $this->belongsTo(\App\Models\PropertyRegion::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')
            ->singleFile();

        $this->addMediaCollection('gallery');

        $this->addMediaConversion('galleryThumb')
            ->optimize()
            ->performOnCollections('gallery');
    }

    public function services()
    {
        return $this->belongsToMany(ExtraService::class, 'property_extra_service');
    }

}
