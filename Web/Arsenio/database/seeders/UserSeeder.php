<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Mizzen',
            'email'=>'mizzen@gmail.com',
            'password'=>bcrypt('M1zz3n2072'),
            'is_login'=>'0',
            'is_active'=>'1',
            'role'=>'admin'
        ]);
    }
}
