<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Room;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'square_meters' => $this->faker->numberBetween(0, 50),
            'theatre_style_capacity' => $this->faker->numberBetween(0, 50),
            'classroom_style_capacity' => $this->faker->numberBetween(0, 50),
            'diplomatic_style_capacity' => $this->faker->numberBetween(0, 50),
            'u_shaped_capacity' => $this->faker->numberBetween(0, 50),
            'inauguration_style_capacity' => $this->faker->numberBetween(0, 50),
            'cabaret_style_capacity' => $this->faker->numberBetween(0, 50),
            'property_id' => Property::factory()->create()
        ];
    }
}
