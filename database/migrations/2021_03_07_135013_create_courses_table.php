<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title', 400);
            $table->decimal('price', 12, 4);
            $table->timestamp('featuring_ended_at')->nullable();
            $table->integer('duration_minutes');
            $table->dateTime('started_at');
            $table->dateTime('ended_at');
            $table->foreignIdFor(\App\Models\Company::class);
            $table->foreignIdFor(\App\Models\Region::class);
            $table->foreignIdFor(\App\Models\CourseCategory::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
