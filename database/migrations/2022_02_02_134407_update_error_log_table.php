<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateErrorLogTable extends Migration
{
    public function up()
    {
        Schema::table('errorlog', function (Blueprint $table) {
            $table->string('application', 50)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropColumn('application');
    }
}
