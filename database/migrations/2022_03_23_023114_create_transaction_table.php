<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('Transac_id');
            $table->unsignedInteger('Book_id');
            $table->foreign('Book_id')->references('Book_id')->on('books')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->unsignedInteger('Borrower_id');
            $table->foreign('Borrower_id')->references('Borrower_id')->on('borrowers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->string('DateBorrowed');
            $table->string('DueDateReturned');
            $table->string('Fullname');
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
        Schema::dropIfExists('transaction');
    }
}
