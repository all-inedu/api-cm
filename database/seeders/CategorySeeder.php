<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
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
                'name' => 'Medical Doctor',
                'status' => 1
            ), 
            array(
                'name' => 'Full Stack Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Psychologist',
                'status' => 1
            ),
            array(
                'name' => 'UX Designer',
                'status' => 1
            ),
            array(
                'name' => 'Biomedical Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Process Control Engineer',
                'status' => 0
            ),
            array(
                'name' => 'Energy Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Aerospace Engineer',
                'status' => 0
            ),
            array(
                'name' => 'Product Designer',
                'status' => 1
            ),
            array(
                'name' => 'Environmental Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Architect',
                'status' => 1
            ),
            array(
                'name' => 'Video Game Designer',
                'status' => 1
            ),
            array(
                'name' => 'Multimedia Artist & Animator',
                'status' => 1
            ),
            array(
                'name' => 'Materials Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Visual Designer',
                'status' => 1
            ),
            array(
                'name' => 'Interior Designer',
                'status' => 1
            ),
            array(
                'name' => 'Content Creator',
                'status' => 0
            ),
            array(
                'name' => 'Copywriter',
                'status' => 1
            ),
            array(
                'name' => 'Dentist',
                'status' => 1
            ),
            array(
                'name' => 'Surgeon',
                'status' => 1
            ),
            array(
                'name' => 'Data Scientist',
                'status' => 1
            ),
            array(
                'name' => 'AI and Machine Learning Specialist',
                'status' => 1
            ),
            array(
                'name' => 'QA Tester',
                'status' => 1
            ),
            array(
                'name' => 'Internet of Things Developer',
                'status' => 1
            ),
            array(
                'name' => 'Management Analyst/Consultant',
                'status' => 1
            ),
            array(
                'name' => 'Business Operations Manager',
                'status' => 1
            ),
            array(
                'name' => 'Financial Analyst',
                'status' => 1
            ),
            array(
                'name' => 'Investment Analyst',
                'status' => 0
            ),
            array(
                'name' => 'Bioinformatician',
                'status' => 1
            ),
            array(
                'name' => 'IT Security',
                'status' => 1
            ),
            array(
                'name' => 'System Analyst',
                'status' => 1
            ),
            array(
                'name' => 'Web Developer',
                'status' => 1
            ),
            array(
                'name' => 'Software Engineer',
                'status' => 1
            ),
            array(
                'name' => 'Speech Pathologist',
                'status' => 1
            ),
            array(
                'name' => 'Veterinarian',
                'status' => 1
            ),
            array(
                'name' => 'Market Research Analyst',
                'status' => 1
            ),
            array(
                'name' => 'Entrepreneur',
                'status' => 0
            ),
            array(
                'name' => 'Actuary',
                'status' => 1
            ),
            array(
                'name' => 'Digital Marketing Specialist',
                'status' => 0
            ),
            array(
                'name' => 'Pharmacist',
                'status' => 0
            ),
            array(
                'name' => 'Urban and Regional Planner',
                'status' => 0
            ),
            array(
                'name' => 'Politician',
                'status' => 0
            ),
            array(
                'name' => 'Accountant',
                'status' => 0
            ),
            array(
                'name' => 'Lawyer',
                'status' => 0
            ),
            array(
                'name' => 'Public Relations',
                'status' => 0
            ),
            array(
                'name' => 'Anthropologist',
                'status' => 0
            ),
            array(
                'name' => 'Event Planner',
                'status' => 0
            ),
            array(
                'name' => 'Epidemiologist',
                'status' => 0
            ),
            array(
                'name' => 'Genetic Counselors',
                'status' => 0
            ),
            array(
                'name' => 'Food Scientist',
                'status' => 1
            ),
        );

        DB::table('categories')->insert($data);
    }
}
