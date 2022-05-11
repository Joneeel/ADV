<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/* Creating a table called borrowers with the following columns:
Borrower_id, fullname, gender, status, address, vio_count, timestamps, resetmonth */
        Schema::create('borrowers', function (Blueprint $table) {
            $table->increments('Borrower_id');
            $table->string('fullname')->unique();
            $table->string('gender');
            $table->string('status');
            $table->string('address');
            $table->integer('vio_count')->default('0');
            $table->timestamps();
            $table->string('resetmonth');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* It drops the table if it exists. */
        Schema::dropIfExists('borrowers');
    }
}
