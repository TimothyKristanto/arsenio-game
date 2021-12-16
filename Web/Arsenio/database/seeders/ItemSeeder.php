<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senrup_items')->insert([
            'name'=>'Perban',
            'image'=>'/images/Perban.png',
            'amount' => 1,
            'single_price' => 250,
            'description' => 'Menambah darah pemain sebanyak 10',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_items')->insert([
            'name'=>'Jamu',
            'image'=>'/images/Jamu.png',
            'amount' => 1,
            'single_price' => 1500,
            'description' => 'Mengisi penuh nyawa pemain',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_items')->insert([
            'name'=>'Jam Pasir',
            'image'=>'/images/JamPasir.png',
            'amount' => 1,
            'single_price' => 400,
            'description' => 'Memperlama waktu menjawab sebuah soal selama 10 detik',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);


    }
}
