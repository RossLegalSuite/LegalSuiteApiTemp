<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApiAccessTable extends Migration
{
    
    public function up()
    {
        
        Schema::table('api_access', function (Blueprint $table) {
            
            
            
            $table->integer('grantAccess')->default(0)->after('getAccessFlag');
            
            
            
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
        $table->dropColumn('grantAccess');
        
    }
}
