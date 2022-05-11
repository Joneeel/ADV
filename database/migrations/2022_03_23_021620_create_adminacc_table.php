<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminaccTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
/* Creating a table called adminaccs with the following columns: Acc_id, name, username, password,
status, and timestamps. */
        Schema::create('adminaccs', function (Blueprint $table) {
            $table->increments('Acc_id');
            $table->string('name')->unique();
            $table->string('username')->unique();
            $table->string('password');
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
        Schema::dropIfExists('adminaccs');
    }
}
