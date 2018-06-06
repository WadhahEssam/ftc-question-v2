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
            $table->string('user-1-ready') ;
            $table->string('user-2-ready') ;
            $table->string('user-1-name') ;
            $table->string('user-2-name') ;
            $table->integer('user-1-points') ;
            $table->integer('user-2-points') ;
            $table->string('user-1-answer') ;
            $table->string('user-2-answer') ;
            $table->integer('question-id') ; 
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
