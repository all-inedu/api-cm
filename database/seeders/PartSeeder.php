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
                'title' => 'Part Dummy 1.a'
            ),
            array(
                'outline_id' => 1,
                'title' => 'Part Dummy 1.b'
            ),
            array(
                'outline_id' => 2,
                'title' => 'Part Dummy 2'
            ),
            array(
                'outline_id' => 3,
                'title' => 'Part Dummy 3'
            ),
            array(
                'outline_id' => 4,
                'title' => 'Part Dummy 4'
            ),
            array(
                'outline_id' => 5,
                'title' => 'Part Dummy 5'
            ),
            array(
                'outline_id' => 6,
                'title' => 'Part Dummy 6'
            )
        );

        DB::table('parts')->insert($data);
    }
}
