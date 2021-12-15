<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('senrup_stories')->insert([
            'title'=>'Awal Mula Perkara',
            'story_desc'=>'Saat Anda ingin menjelajah 
                            untuk benda kuno tersebut, Anda 
                            menemukan Hutan Nawa di mana 
                            Anda bertemu para monster Sanghara 
                            untuk pertama kali nya, Tampaknya 
                            mereka menghalangi jalan Anda untuk 
                            mendapatkan benda kuno untuk kerajaan Anda. 
                            Sepertinya Anda akan berjuang untuk melewatinya.',
            'image'=>'/images/StoryHutan.png',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_stories')->insert([
            'title'=>'Gua Kebohongan',
            'story_desc'=>'Setelah mengalahkan monster sebelumnya, kamu lanjutkan perjalananmu untuk mendapatkan Nawasena. Anda mulai mendaki gunung dan melihat lebih banyak monster menjaga gua. Anda berasumsi bahwa Nawasena akan berada di gua itu. Tanpa ragu-ragu Anda pergi untuk melawan mereka untuk mendapatkan Nawasena itu untuk kerajaan Anda.',
            'image'=>'/images/StoryGua.png',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
