<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            // $table->increments('id');
            $table->bigIncrements('id');
            $table->string('company_name')->unique();
            $table->string('name');
            $table->string('website')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('dbHost')->nullable();
            $table->string('dbPort')->default('1433');
            $table->string('dbDatabase')->nullable();
            $table->string('dbUser')->nullable();
            $table->string('dbPassword')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('clients');
    }
};
