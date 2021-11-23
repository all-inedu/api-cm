<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = 
        array(
            array(
                'module_name' => 'Digital Marketing',
                'desc' => 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.',
                'category' => 'digital marketing, ui/ux designer',
                'price' => 'FREE',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'module_name' => 'Data Scientist',
                'desc' => 'Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget tortor risus. Donec sollicitudin molestie malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.',
                'category' => 'data scientist, machine learning',
                'price' => 'FREE',
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        

        DB::table('modules')->insert($data);
    }
}
