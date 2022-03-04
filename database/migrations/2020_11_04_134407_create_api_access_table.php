<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiAccessTable extends Migration
{
    
    public function up()
    {
        Schema::create('api_access', function (Blueprint $table) {
            
            $table->increments('id');
            //  $table->bigInteger('clientId');
            // $table->bigInteger('developerId');
            $table->string('clientId');
            $table->string('developerId');
            $table->string('api_token');
            
            $table->integer('deleteAccessFlag')->default(0);
            $table->integer('putAccessFlag')->default(0);
            $table->integer('postAccessFlag')->default(0);
            $table->integer('getAccessFlag')->default(0);
            
            
            
            $table->timestamps();
            
            // $table->foreign('clientId')
            // ->references('id')->on('clients')
            // ->onDelete('cascade');
            
            // $table->foreign('developerId')
            // ->references('id')->on('developers')
            // ->onDelete('cascade');
            
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('api_access');
    }
}
