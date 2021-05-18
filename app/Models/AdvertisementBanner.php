<?php

namespace App\Models;

use App\Enums\AdTypeEnum;
use BenSampo\Enum\Traits\CastsEnums;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AdvertisementBanner extends Model implements Viewable, HasMedia
{
    use HasFactory, InteractsWithViews, InteractsWithMedia, CastsEnums;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'note',
        'type',
        'url'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => AdTypeEnum::class,

        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];
}
