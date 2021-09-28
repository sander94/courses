<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseTypesTable extends Migration
{
    public function up()
    {
        Schema::create('course_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->boolean('show_on_search_page');
            $table->timestamps();
        });
        Schema::table('courses', function (Blueprint $table) {
            $table->foreignId('course_type_id')->index();
        });


        $types = [
            '24/7 courses' => true,
            'Orderable courses' => true,
            'Live courses' => false
        ];

        foreach ($types as $type => $isSearchable) {
            \App\Models\CourseType::query()->create([
                'title' => $type,
                'show_on_search_page' => $isSearchable
            ]);
        }

        \Illuminate\Support\Facades\DB::beginTransaction();

        try {
            $orderable = \App\Models\CourseType::query()->where('title', 'Orderable courses')->firstOrFail();
            $live = \App\Models\CourseType::query()->where('title', 'Live courses')->firstOrFail();

            \App\Models\Course::query()->each(function (\App\Models\Course $course) use ($orderable, $live) {
                $course->courseType()->associate($live);

                if ($course->started_at === null) {
                    $course->courseType()->associate($orderable);
                }

                $course->save();
            });
        } catch (Throwable $throwable) {
            DB::rollBack();

            throw $throwable;
        }

        DB::commit();

    }

    public function down()
    {
        Schema::dropIfExists('course_types');
    }
}
