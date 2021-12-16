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
            'story_desc'=>'Pada zaman dahulu kala, terdapat sebuah ramalan terhadap kerajaan Arsenio. Dalam ramalan tersebut, kerajaan Arsenio akan menghadapi ancaman yang sangat luar biasa sehingga menyebabkan kerajaan tersebut hancur. Namun, pada zaman itu, tidak ada satupun orang yang percaya akan ramalan itu. Beberapa tahun kemudian, Ketidakpercayaan ini kemudian menimbulkan sebuah kecemasan pada kerajaan tersebut akibat ramalan yang terdahulu benar-benar terjadi. Pada tahun 612, terdapat sebuah batu angkasa yang jatuh di dekat kerajaan Arsenio yang menjadi asal usul lahirnya monster yang bernama Sanghara. Awalnya kerajaan Arsenio tidak ingin percaya akan keberadaan monster tersebut. Namun setelah diinvestigasi lebih lanjut bahkan terdapat sebuah korban dari warga kerajaan akibat keganasan monster Sanghara, kerajaan Arsenio terpaksa untuk mempercayai ramalan yang terdahulu. Kerajaan Arsenio pun teringat cara untuk menghadapi para monster tersebut yang tercantum pada ramalan terdahulu yaitu dengan benda kuno bernama Nawasena. Maka dari itu, kerajaan Arsenio memerintahkan Anda untuk mencari benda kuno tersebut agar kerajaan Arsenio dapat terselematkan dari ancaman maut.Saat Anda ingin menjelajah 
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
