<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelRewardRelationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>11,
            'reward_id'=>1,
            'reward_amount'=>500,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>11,
            'reward_id'=>2,
            'reward_amount'=>15,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>12,
            'reward_id'=>1,
            'reward_amount'=>500,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>12,
            'reward_id'=>2,
            'reward_amount'=>15,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>13,
            'reward_id'=>1,
            'reward_amount'=>500,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>13,
            'reward_id'=>2,
            'reward_amount'=>15,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>14,
            'reward_id'=>1,
            'reward_amount'=>600,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>14,
            'reward_id'=>2,
            'reward_amount'=>20,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>15,
            'reward_id'=>1,
            'reward_amount'=>1000,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>15,
            'reward_id'=>2,
            'reward_amount'=>30,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>21,
            'reward_id'=>1,
            'reward_amount'=>600,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>21,
            'reward_id'=>2,
            'reward_amount'=>20,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>22,
            'reward_id'=>1,
            'reward_amount'=>600,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>22,
            'reward_id'=>2,
            'reward_amount'=>20,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>23,
            'reward_id'=>1,
            'reward_amount'=>600,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>23,
            'reward_id'=>2,
            'reward_amount'=>20,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>24,
            'reward_id'=>1,
            'reward_amount'=>650,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>24,
            'reward_id'=>2,
            'reward_amount'=>25,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>25,
            'reward_id'=>1,
            'reward_amount'=>1200,
        ]);

        DB::table('senrup_levels_rewards')->insert([
            'level_id'=>25,
            'reward_id'=>2,
            'reward_amount'=>40,
        ]);
    }
}
