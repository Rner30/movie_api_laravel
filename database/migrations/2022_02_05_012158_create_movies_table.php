<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{

    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('title')->unique();
            $table->string('description');
            $table->date('publishDate');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
