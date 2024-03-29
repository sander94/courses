<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        \App\Models\User::factory()->create(
            ['email' => 'test@test.com', 'is_admin' => true]
        );

        \App\Models\Company::factory()->create(
            ['email' => 'test@test.com']
        );

        CourseCategory::factory(10)->create();
        Course::factory(10)->create();

        Article::factory(10)->create();
        Room::factory(10)->create();
    }
}
