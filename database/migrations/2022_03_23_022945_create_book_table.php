<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/* Creating a table called books with the following columns:
Book_id, Title, Author, Copyright, Type, Category, No_pages, Stock, status, timestamps */
        Schema::create('books', function (Blueprint $table) {
            $table->increments('Book_id');
            $table->string('Title');
            $table->string('Author');
            $table->string('Copyright');
            $table->string('Type');
            $table->string('Category');
            $table->integer('No_pages');
            $table->integer('Stock');
            $table->string('status');
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
       /* Dropping the table if it exists. */
        Schema::dropIfExists('books');
    }
}
