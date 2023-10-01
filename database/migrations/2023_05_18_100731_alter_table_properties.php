<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('instagram_url')->nullable()->default(null);
            $table->string('slug')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->text('meta_description')->nullable()->default(null);
            $table->string('page_title_tag')->nullable()->default(null);
            $table->string('logo_title_tag')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('instagram_url');
            $table->dropColumn('slug');
            $table->dropColumn('description');
            $table->dropColumn('meta_description');
            $table->dropColumn('page_title_tag');
            $table->dropColumn('logo_title_tag');
        });
    }
}
