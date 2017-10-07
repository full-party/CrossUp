<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharactersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('game_id')->index('id_idx');
            $table->string('name', 45)->nullable();
            $table->string('image', 200)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('characters');
    }

}
