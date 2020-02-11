<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'first_name' => 'Admin',
            'title' => 'Mr',
            'last_name' => 'Admin',
            'phone_number' => 'Admin',
            'address' => 'Admin',
            'country' => 'Admin',
            'country' => 'Admin',
            'email' => 'admin@gmail.com',
            'authority'  =>  'supper_admin',
            'password' => bcrypt('password'),
        ]);
    }
}
