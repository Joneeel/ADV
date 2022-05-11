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
/* Creating a table named transactions with the following columns:
- Transac_id
- Book_id
- Borrower_id
- DateBorrowed
- DueDateReturned
- Fullname
- BookTitle
- created_at
- updated_at */
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('Transac_id');
            $table->unsignedInteger('Book_id');
            $table->foreign('Book_id')->references('Book_id')->on('books')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->unsignedInteger('Borrower_id');
            $table->foreign('Borrower_id')->references('Borrower_id')->on('borrowers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->timestamp('DateBorrowed')->useCurrent();
            $table->timestamp('DueDateReturned')->useCurrent();
            $table->string('Fullname');
            $table->string('BookTitle');
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
        /* It drops the table if it exists. */
        Schema::dropIfExists('transaction');
    }
}
