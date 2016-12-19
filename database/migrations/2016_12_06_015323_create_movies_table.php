<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $path = public_path() . "/img/posters";
            if (!File::exists($path)) {
                File::makeDirectory($path);
                $table->increments('id');
                $table->timestamps();

                $table->string('title');
                $table->string('url');
                $table->text('synopsis');
                $table->integer('released');
                $table->string('poster');
                $table->boolean('available');
            }
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
