<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OutlineSeeder extends Seeder
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
                'module_id' => 3,
                'section_id' => 1,
                'name' => 'This is Outline A From Dummy Module 1',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            ),
            array(
                'module_id' => 3,
                'section_id' => 2,
                'name' => 'This is Outline B From Dummy Module 1',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            ),
            array(
                'module_id' => 3,
                'section_id' => 3,
                'name' => 'This is Outline C From Dummy Module 1',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            ),
            array(
                'module_id' => 4,
                'section_id' => 1,
                'name' => 'This is Outline A From Dummy Module 2',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            ),
            array(
                'module_id' => 4,
                'section_id' => 2,
                'name' => 'This is Outline B From Dummy Module 2',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            ),
            array(
                'module_id' => 4,
                'section_id' => 1,
                'name' => 'This is Outline A From Dummy Module 1',
                'desc' => 'Pellentesque in ipsum id orci porta dapibus. Vivamus suscipit tortor eget felis porttitor volutpat.'
            )
        );

        DB::table('outlines')->insert($data);
    }
}
