<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // admin user
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // admin
        ]);

        // instructor user
        DB::table('users')->insert([
            'name' => 'John Instructor',
            'email' => 'instructor@example.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // instructor
        ]);
        
        // student user
        DB::table('users')->insert([
            'name' => 'Jane Student',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role_id' => 3, // student
        ]);
    }
}