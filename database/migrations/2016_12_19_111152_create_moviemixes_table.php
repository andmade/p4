<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviemixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_mixes', function (Blueprint $table) {
            $path = public_path() . "/img/mixescovers";
            if (!File::exists($path)) {
                File::makeDirectory($path);
            };
            $table->increments('id');
            $table->timestamps();

            $table->string('name', 64);
            $table->boolean('public');
            $table->string('cover')->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        File::deleteDirectory(public_path() . "/img/mixescovers");
        Schema::dropIfExists('movie_mixes');
    }
}
