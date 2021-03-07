<?php

namespace Tests\Feature\Http\Controllers;

use App\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\CourseController
 */
class CourseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->get(route('course.index'));

        $response->assertOk();
        $response->assertViewIs('course.index');
        $response->assertViewHas('courses');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('course.create'));

        $response->assertOk();
        $response->assertViewIs('course.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'store',
            \App\Http\Requests\CourseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $title = $this->faker->sentence(4);
        $duration_seconds = $this->faker->numberBetween(-10000, 10000);

        $response = $this->post(route('course.store'), [
            'title' => $title,
            'duration_seconds' => $duration_seconds,
        ]);

        $courses = Course::query()
            ->where('title', $title)
            ->where('duration_seconds', $duration_seconds)
            ->get();
        $this->assertCount(1, $courses);
        $course = $courses->first();

        $response->assertRedirect(route('course.index'));
        $response->assertSessionHas('course.id', $course->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.show', $course));

        $response->assertOk();
        $response->assertViewIs('course.show');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $course = Course::factory()->create();

        $response = $this->get(route('course.edit', $course));

        $response->assertOk();
        $response->assertViewIs('course.edit');
        $response->assertViewHas('course');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\CourseController::class,
            'update',
            \App\Http\Requests\CourseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $course = Course::factory()->create();
        $title = $this->faker->sentence(4);
        $duration_seconds = $this->faker->numberBetween(-10000, 10000);

        $response = $this->put(route('course.update', $course), [
            'title' => $title,
            'duration_seconds' => $duration_seconds,
        ]);

        $course->refresh();

        $response->assertRedirect(route('course.index'));
        $response->assertSessionHas('course.id', $course->id);

        $this->assertEquals($title, $course->title);
        $this->assertEquals($duration_seconds, $course->duration_seconds);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $course = Course::factory()->create();

        $response = $this->delete(route('course.destroy', $course));

        $response->assertRedirect(route('course.index'));

        $this->assertDeleted($course);
    }
}
