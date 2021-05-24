<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\PropertyRegion;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Property;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'company_name' => $this->faker->word,
            'address' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'property_region_id' => PropertyRegion::factory()->create()
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Property $property) {
            $property->addMediaFromUrl($this->faker->imageUrl())->toMediaCollection('cover');
        });
    }
}
