<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDevelopersTable extends Migration
{
    public function up()
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->integer('deleteAccessFlag')->default(0)->after('isNotActive');
            $table->integer('putAccessFlag')->default(0)->after('isNotActive');
            $table->integer('postAccessFlag')->default(0)->after('isNotActive');
            $table->integer('getAccessFlag')->default(0)->after('isNotActive');
            $table->string('developer_token')->after('password');

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
        $table->dropColumn('deleteAccessFlag');
        $table->dropColumn('putAccessFlag');
        $table->dropColumn('postAccessFlag');
        $table->dropColumn('getAccessFlag');
        $table->dropColumn('developer_token');
    }
}
