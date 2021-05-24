<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'square_meters',
        'theatre_style_capacity',
        'classroom_style_capacity',
        'diplomatic_style_capacity',
        'u_shaped_capacity',
        'inauguration_style_capacity',
        'cabaret_style_capacity',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];


    public function property()
    {
        return $this->belongsTo(\App\Models\Property::class);
    }

}
