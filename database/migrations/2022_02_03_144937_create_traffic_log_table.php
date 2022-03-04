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
        Schema::create('trafficlog', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('ip', 50);
            $table->string('url', 254);
            $table->string('method', 20);
            $table->string('httpStatusCode', 50);
            $table->string('clientId', 20)->nullable();
            $table->string('developerId', 20)->nullable();
            $table->string('executionTime', 50);
            $table->Text('parameters')->nullable();

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
        Schema::dropIfExists('trafficlog');
    }
};
