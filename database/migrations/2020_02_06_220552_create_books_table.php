<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable($value = true);;
            $table->string('author')->nullable($value = true);
            $table->string('publisher')->nullable($value = true);
            $table->string('series')->nullable($value = true);
            $table->string('isbn')->nullable($value = true);
            $table->string('cover_image_url')->nullable($value = true);
            $table->bigInteger('number_of_pages')->nullable($value = true);
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
        Schema::dropIfExists('books');
    }
}
