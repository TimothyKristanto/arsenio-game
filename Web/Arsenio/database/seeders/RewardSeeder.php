<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('senrup_rewards')->insert([
            'name' => 'Emas',
            'image' => '/images/Gold.png'

        ]);
        DB::table('senrup_rewards')->insert([
            'name' => 'Exp',
            'image' => '/images/Exp.png'
        ]);
    }
}
