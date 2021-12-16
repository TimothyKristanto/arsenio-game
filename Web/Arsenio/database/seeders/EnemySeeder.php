<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EnemySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senrup_enemies')->insert([
            'name' => 'Tulang Belulang',
            'image' => '/images/MonsterSkeleton.png',
            'damage' => 30,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_enemies')->insert([
            'name' => 'Iblis Kecil',
            'image' => '/images/MonsterIblis.png',
            'damage' => 35,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_enemies')->insert([
            'name' => 'Serigala Kekar',
            'image' => '/images/MonsterSerigala.png',
            'damage' => 40,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_enemies')->insert([
            'name' => 'Penyihir Licik',
            'image' => '/images/MonsterPenyihir.png',
            'damage' => 50,
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
