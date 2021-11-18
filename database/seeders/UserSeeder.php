<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 3 ; $i < 15 ; $i++) {
            $array[] = array(
                'first_name' => 'student',
                'last_name' => 'dummy '.$i,
                'birthday' => '1995-10-10',
                'phone_number' => '08122366457',
                'role_id' => 1,
                'email' => 'student_dummy_'.$i.'@all-inedu.com', //TODO diganti sesuai real email student dummy 
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'address' => null,
                'total_exp' => 0,
                'profile_picture' => null,
                'imported_from' => null,
                'ext_id' => null,
                'status' => true,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_verified' => ( ($i > 5) && ($i < 8) ) ? 0 : 1
            );
        }

        $data = array(
            array(
                'first_name' => 'super',
                'last_name' => 'admin',
                'birthday' => null,
                'phone_number' => null,
                'role_id' => 2,
                'email' => 'admin@all-inedu.com', //TODO diganti sesuai real email admin 
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('admin123'),
                'address' => null,
                'total_exp' => 0,
                'profile_picture' => null,
                'imported_from' => null,
                'ext_id' => null,
                'status' => true,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_verified' => 1
            ),
            array(
                'first_name' => 'student',
                'last_name' => 'dummy',
                'birthday' => '1995-10-10',
                'phone_number' => '08122366457',
                'role_id' => 1,
                'email' => 'hafidz.fanany@all-inedu.com', //TODO diganti sesuai real email student dummy 
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'address' => null,
                'total_exp' => 0,
                'profile_picture' => null,
                'imported_from' => null,
                'ext_id' => null,
                'status' => true,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_verified' => 1
            ),
            array(
                'first_name' => 'student',
                'last_name' => 'dummy 2',
                'birthday' => '1995-10-10',
                'phone_number' => '08122366457',
                'role_id' => 1,
                'email' => 'manuel.eric@all-inedu.com', //TODO diganti sesuai real email student dummy 
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'address' => null,
                'total_exp' => 0,
                'profile_picture' => null,
                'imported_from' => null,
                'ext_id' => null,
                'status' => true,
                'remember_token' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'is_verified' => 1
            )
        );

        $data = array_merge($data, $array);

        DB::table('users')->insert($data);
    }
}
