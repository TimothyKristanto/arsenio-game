<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterExpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('senrup_character_exps')->insert([
            'health'=>105,
            'level_up_exp'=>10,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>110,
            'level_up_exp'=>15,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>115,
            'level_up_exp'=>25,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>130,
            'level_up_exp'=>40,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>140,
            'level_up_exp'=>60,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>145,
            'level_up_exp'=>90,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>150,
            'level_up_exp'=>140,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>160,
            'level_up_exp'=>190,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>170,
            'level_up_exp'=>250,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>180,
            'level_up_exp'=>310,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>190,
            'level_up_exp'=>380,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>200,
            'level_up_exp'=>450,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>200,
            'level_up_exp'=>530,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>210,
            'level_up_exp'=>610,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>210,
            'level_up_exp'=>700,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
                'health'=>230,
                'level_up_exp'=>800,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>240,
            'level_up_exp'=>900,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>250,
            'level_up_exp'=>1000,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>260,
            'level_up_exp'=>1100,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>270,
            'level_up_exp'=>1200,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
