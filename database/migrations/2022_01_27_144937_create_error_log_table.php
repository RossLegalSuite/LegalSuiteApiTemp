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
        Schema::create('errorlog', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('ip', 50);
            $table->string('url', 254)->nullable();
            $table->string('method', 20)->nullable();
            $table->Text('parameters')->nullable();
            $table->string('clientId', 20)->nullable();
            $table->string('developerId', 20)->nullable();
            $table->Text('message')->nullable();
            $table->string('file', 254)->nullable();
            $table->string('line', 20)->nullable();

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
        Schema::dropIfExists('errorlog');
    }
};
