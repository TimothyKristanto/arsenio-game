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
            'damage'=>20,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>110,
            'level_up_exp'=>15,
            'damage'=>25,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>115,
            'level_up_exp'=>25,
            'damage'=>30,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>130,
            'level_up_exp'=>40,
            'damage'=>35,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>140,
            'level_up_exp'=>60,
            'damage'=>40,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>145,
            'level_up_exp'=>90,
            'damage'=>45,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>150,
            'level_up_exp'=>140,
            'damage'=>50,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>160,
            'level_up_exp'=>190,
            'damage'=>55,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>170,
            'level_up_exp'=>250,
            'damage'=>60,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>180,
            'level_up_exp'=>310,
            'damage'=>65,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>190,
            'level_up_exp'=>380,
            'damage'=>70,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>200,
            'level_up_exp'=>450,
            'damage'=>75,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>200,
            'level_up_exp'=>530,
            'damage'=>85,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>210,
            'level_up_exp'=>610,
            'damage'=>90,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>210,
            'level_up_exp'=>700,
            'damage'=>100,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
                'health'=>230,
                'level_up_exp'=>800,
                'damage'=>100,
                'created_at'=>\Carbon\Carbon::now(),
                'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>240,
            'level_up_exp'=>900,
            'damage'=>105,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>250,
            'level_up_exp'=>1000,
            'damage'=>110,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>260,
            'level_up_exp'=>1100,
            'damage'=>115,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_character_exps')->insert([
            'health'=>270,
            'level_up_exp'=>1200,
            'damage'=>120,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
