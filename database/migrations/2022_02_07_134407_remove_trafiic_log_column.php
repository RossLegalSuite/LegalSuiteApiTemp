<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveTrafiicLogColumn extends Migration
{
    public function up()
    {
        Schema::table('trafficlog', function (Blueprint $table) {
            $table->dropColumn('parameters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->text('parameters')->after('id');
    }
}
