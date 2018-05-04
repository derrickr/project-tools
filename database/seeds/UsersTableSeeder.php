<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'first_name' => 'Mark',
            'last_name' => 'Smith',
            'email' => 'mark.smith@project-tools.co.uk',
            'password' => bcrypt('Admin@2018'),
            'role' => 'admin',
        ]);
    }
}
