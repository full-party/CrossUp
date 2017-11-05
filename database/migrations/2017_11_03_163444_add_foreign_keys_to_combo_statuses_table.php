<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToComboStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combo_statuses', function (Blueprint $table) {
            $table->foreign('combo_id', 'combo_combo_statuses_id')->references('id')->on('combos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('status_id', 'status_combo_statuses_id')->references('id')->on('statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combo_statuses', function (Blueprint $table) {
            $table->dropForeign('combo_combo_statuses_id');
            $table->dropForeign('status_combo_statuses_id');
        });
    }
}
