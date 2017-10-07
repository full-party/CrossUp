<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('character_id')->index('_idx');
            $table->string('name', 200)->nullable();
            $table->integer('damage')->nullable();
            $table->integer('stun')->nullable();
            $table->integer('meter')->nullable();
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
        Schema::drop('moves');
    }

}
