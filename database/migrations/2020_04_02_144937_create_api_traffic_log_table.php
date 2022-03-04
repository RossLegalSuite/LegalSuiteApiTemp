<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiTrafficLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apitrafficlog', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('ip', 254)->nullable();
            $table->Text('fullUrl')->nullable();
            $table->string('url', 254)->nullable();
            $table->string('path', 254)->nullable();
            $table->string('method', 254)->nullable();
            $table->decimal('executionTime')->nullable();
            $table->string('getStatusCode', 254)->nullable();
            $table->string('companyId', 254)->nullable();
            $table->string('companyName', 254)->nullable();
            $table->string('appId', 254)->nullable();
            $table->Text('parameters')->nullable();
            $table->Text('userAgent')->nullable();
            $table->Text('header')->nullable();

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
        Schema::dropIfExists('apitrafficlog');
    }
}
