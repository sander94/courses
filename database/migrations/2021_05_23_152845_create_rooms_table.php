<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('square_meters');
            $table->string('theatre_style_capacity')->nullable();
            $table->string('classroom_style_capacity')->nullable();
            $table->string('diplomatic_style_capacity')->nullable();
            $table->string('u_shaped_capacity')->nullable();
            $table->string('inauguration_style_capacity')->nullable();
            $table->string('cabaret_style_capacity')->nullable();
            $table->foreignIdFor(\App\Models\Property::class);
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
        Schema::dropIfExists('rooms');
    }
}
