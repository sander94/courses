<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->sentence(4),
            'featuring_ended_at' => $this->faker->dateTime(),
            'price' => $this->faker->numberBetween(300, 1500),
            'duration_minutes' => $this->faker->numberBetween(3600, 96000),
            'started_at' => $this->faker->dateTime('+1 day'),
            'ended_at' => $this->faker->dateTime('+1 week'),

            'course_category_id' => CourseCategory::factory()->create(),
            'region_id' => Region::factory()->create(),
            'company_id' => Company::factory()->create(),
        ];
    }
}
