<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoryLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senrup_story_levels')->insert([
            'level_id'=>11,
            'story_id'=>1,
            'open_status'=>true,
            'level_finished'=>false,
            'enemy_id'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
        
        DB::table('senrup_story_levels')->insert([
            'level_id'=>12,
            'story_id'=>1,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>13,
            'story_id'=>1,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>14,
            'story_id'=>1,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>1,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>15,
            'story_id'=>1,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>2,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>21,
            'story_id'=>2,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>22,
            'story_id'=>2,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>23,
            'story_id'=>2,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>24,
            'story_id'=>2,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>3,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_story_levels')->insert([
            'level_id'=>25,
            'story_id'=>2,
            'open_status'=>false,
            'level_finished'=>false,
            'enemy_id'=>4,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
