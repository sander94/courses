<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\UserProfile;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'company_reg_no' => $this->faker->word,
            'brand_name' => $this->faker->word,
            'county' => $this->faker->word,
            'city' => $this->faker->city,
            'address' => $this->faker->word,
            'additional_info' => $this->faker->text,
        ];
    }
}
