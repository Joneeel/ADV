<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\adminacc;

class adminaccSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

/* Checking if the table is empty, if it is empty it will create 10 rows of data. */
        if (adminacc::count() == 0) {
            adminacc::factory(10)->create();
        }

/* Inserting a row of data into the database. */
        DB::table('adminaccs')->insert([
            'name' => 'henz',
            'username' => 'awtsgege',
            'password' => '123123',
            'status' => 'Y',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        /*

        DB::table('adminacc')->insert([
            'name' => 'zef',
            'username' => 'qwerty',
            'password' => '321321',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('adminacc')->insert([
            'name' => 'ako',
            'username' => 'asdasd',
            'password' => 'zxczxc',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('adminacc')->insert([
            'name' => 'gaya',
            'username' => '123456',
            'password' => 'qwertyasd',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]); */
    }
}
