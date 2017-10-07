<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCombosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('combos', function (Blueprint $table) {
            $table->foreign('character_id', 'character_combo_id')->references('id')->on('characters')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('user_id', 'user_combo_id')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('combos', function (Blueprint $table) {
            $table->dropForeign('character_combo_id');
            $table->dropForeign('user_combo_id');
        });
    }

}
