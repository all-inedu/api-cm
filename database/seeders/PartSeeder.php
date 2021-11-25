<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            array(
                'outline_id' => 1,
                'name' => 'This is Part A'
            ),
            array(
                'outline_id' => 2,
                'name' => 'This is Part B'
            )
        );

        DB::table('parts')->insert($data);
    }
}
