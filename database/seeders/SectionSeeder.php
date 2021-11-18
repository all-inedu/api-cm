<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
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
                'name' => 'Introduction',
            ),
            array(
                'name' => 'Core Tasks',
            ),
            array(
                'name' => 'Types',
            ),
            array(
                'name' => 'Pathway',
            ),
            array(
                'name' => 'Case Studies',
            ),
            array(
                'name' => 'Reflection',
            ),
            array(
                'name' => 'Glossary',
            ),
            array(
                'name' => 'Additional Resources',
            )
        );

        DB::table('sections')->insert($data);
    }
}
