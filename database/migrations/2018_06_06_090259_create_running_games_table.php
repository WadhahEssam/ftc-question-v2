<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunningGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('running_games', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('user_1_ready') ;
            $table->tinyInteger('user_2_ready') ;
            $table->string('user_1_name') ;
            $table->string('user_2_name') ;
            $table->integer('user_1_points') ;
            $table->integer('user_2_points') ;
            $table->tinyInteger('user_1_answer') ;
            $table->tinyInteger('user_2_answer') ;
            $table->integer('question_id') ;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('running_games');
    }
}
