<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
            'reg_number' => $this->faker->randomNumber(),
            'brand' => $this->faker->word,
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'postal' => $this->faker->postcode,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Company $company) {
            $region = Region::factory()->create();

            $company->region()->associate($region);
        })->afterCreating(function (Company $company) {
            $company->addMediaFromUrl($this->faker->imageUrl())->toMediaCollection('cover');
        });
    }
}
