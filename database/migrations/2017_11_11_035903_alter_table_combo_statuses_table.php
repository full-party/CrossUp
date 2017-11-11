<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableComboStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_statuses', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->rename('combo_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_status', function (Blueprint $table) {
            $table->softDeletes();
            $table->rename('combo_statuses');
        });
    }
}
