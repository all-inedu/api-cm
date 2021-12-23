<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElementSeeder extends Seeder
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
                'part_id' => 1,
                'category_element' => 'text',
                'description' => 'some description about this part',
                'video_link' => null,
                'image_path' => null,
                'file_path' => null,
                'question' => null,
                'total_point' => 0,
                'order' => 1,
                'group' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'part_id' => 1,
                'category_element' => 'text',
                'description' => 'another description about this part',
                'video_link' => null,
                'image_path' => null,
                'file_path' => null,
                'question' => null,
                'total_point' => 0,
                'order' => 2,
                'group' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'part_id' => 1,
                'category_element' => 'text',
                'description' => 'some another description about this part',
                'video_link' => null,
                'image_path' => null,
                'file_path' => null,
                'question' => null,
                'total_point' => 0,
                'order' => 3,
                'group' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'part_id' => 1,
                'category_element' => 'video',
                'description' => null,
                'video_link' => '<iframe width="1520" height="561" src="https://www.youtube.com/embed/MzgMBrtrFc4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'image_path' => null,
                'file_path' => null,
                'question' => null,
                'total_point' => 0,
                'order' => 1,
                'group' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ),
            array(
                'part_id' => 2,
                'category_element' => 'text',
                'description' => 'this is description \'a\' for part id 2',
                'video_link' => null,
                'image_path' => null,
                'file_path' => null,
                'question' => null,
                'total_point' => 0,
                'order' => 1,
                'group' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );

        DB::table('elements')->insert($data);
    }
}
