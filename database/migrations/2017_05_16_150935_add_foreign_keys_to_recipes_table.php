<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecipesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->foreign('combo_id', 'combo_recipe_id')->references('id')->on('combos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign('move_id', 'move_recipe_id')->references('id')->on('moves')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropForeign('combo_recipe_id');
            $table->dropForeign('move_recipe_id');
        });
    }

}
