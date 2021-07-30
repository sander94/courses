<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUsernameToCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropUnique('companies_email_unique');
            $table->string('username')->nullable()->unique();
        });

        \App\Models\Company::query()->each(function (\App\Models\Company $company) {
            $emailParts = explode('@', $company->email);
            $domainPart = explode('.', $emailParts[1])[0];
            $company->username = "{$emailParts[0]}{$domainPart}";
            $company->save();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropUnique('companies_username_unique');
            $table->dropColumn('username');
            $table->unique('email');
        });
    }
}
