<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieMoviemixTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_movie_mix', function (Blueprint $table) {

            $table->increments('id');
            $table->timestamps();

            $table->integer('movie_mix_id')->unsigned();
            $table->integer('movie_id')->unsigned();

            $table->foreign('movie_mix_id')->references('id')->on('movie_mixes');
            $table->foreign('movie_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_moviemix');
    }
}
