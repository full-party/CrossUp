<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCombosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('character_id')->index('id_idx');
            $table->integer('damage')->nullable();
            $table->integer('stun')->nullable();
            $table->string('memo', 200)->nullable();
            $table->integer('user_id')->index('id_idx1');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('combos');
    }

}
