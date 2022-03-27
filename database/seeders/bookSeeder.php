<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\book;

class bookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        if (book::count() == 0) {
            book::factory(10)->create();
        }

        /* DB::table('book')->insert([
            'Title' => 'henz',
            'Author' => 'awtsgege',
            'Copyright' => '123123',
            'No_pages' => '123123',
            'Stock' => '123123',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('book')->insert([
            'Title' => 'zef',
            'Author' => 'qwerty',
            'Copyright' => '321321',
            'No_pages' => '123123',
            'Stock' => '123123',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('book')->insert([
            'Title' => 'ako',
            'Author' => 'asdasd',
            'Copyright' => 'zxczxc',
            'No_pages' => '123123',
            'Stock' => '123123',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('book')->insert([
            'Title' => 'gaya',
            'Author' => '123456',
            'Copyright' => 'qwertyasd',
            'No_pages' => '123123',
            'Stock' => '123123',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]); */
    }
}
