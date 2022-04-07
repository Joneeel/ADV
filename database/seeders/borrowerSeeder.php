<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\borrower;

class borrowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (borrower::count() == 0) {
            borrower::factory(20)->create();
        }

       /* DB::table('borrower')->insert([
            'fullname' => 'henz',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('borrower')->insert([
            'fullname' => 'zef',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('borrower')->insert([
            'fullname' => 'ako',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]);

        DB::table('borrower')->insert([
            'fullname' => 'gaya',
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ]); */
    } 
}
