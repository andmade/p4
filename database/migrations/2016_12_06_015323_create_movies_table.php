<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {

            File::makeDirectory(public_path() . "/img/posters");
            $table->increments('id');
            $table->timestamps();

            $table->string('title');
            $table->text('synopsis');
            $table->integer('released');
            $table->string('poster');
            $table->boolean('available');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        File::deleteDirectory(public_path() . "/img/posters");
        Schema::dropIfExists('movies');
    }
}
