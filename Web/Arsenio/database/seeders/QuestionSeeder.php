<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('senrup_questions')->insert([
            'question'=>'Karya patung yang hanya memperlihatkan bagian badan, dada, pinggang, dan pinggul dinamakan ?',
            'correct_answer'=>'Patung torso',
            'answer_b'=>'patung wajah',
            'answer_c'=>'Patung dekorasi',
            'answer_d'=>'Patung lengkap',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu teknik seni rupa menggunakan cat air dengan sapuan yang tipis, sehingga menghasilkan tampilan yang transparan dan tembus pandang dinamakan teknik ?',
            'correct_answer'=>'Akuarel',
            'answer_b'=>'al-secco',
            'answer_c'=>'Komposisi',
            'answer_d'=>'Proporsi',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Menggunakan pensil gambar dengan memberi titik-titik dalam menentukan gelap terang dinamakan ?',
            'correct_answer'=>'Pointilis',
            'answer_b'=>'arsir',
            'answer_c'=>'Blok',
            'answer_d'=>'Dusel',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu teknik yang menutup obyek gambar dengan satu warna hingga tampak globalnya dinamakan teknik ?',
            'correct_answer'=>'Blok',
            'answer_b'=>'Akuarel',
            'answer_c'=>'Plakat',
            'answer_d'=>'Dusel',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Berikut ini yang termasuk peralatan seni lukis yaitu ?',
            'correct_answer'=>'Cat minyak',
            'answer_b'=>'Dinding',
            'answer_c'=>'Kaca',
            'answer_d'=>'Kertas',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Pengertian karya seni rupa murni adalah karya seni yang lebih mementingkan ?',
            'correct_answer'=>'keindahan dibandingkan fungsi pakainya',
            'answer_b'=>'teknik pembuatannya',
            'answer_c'=>'fungsi pakai dibandingkan keindahan',
            'answer_d'=>'keindahan dibandingkan nilai komersilnya',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kedudukan struktur tulang dan otot-otot yang menentukan besar kecil dan cekung tubuh manusia dalam bentuk keseluruhan tubuh dinamakan ?',
            'correct_answer'=>'Anatomi',
            'answer_b'=>'Posisi',
            'answer_c'=>'Figuratif',
            'answer_d'=>'Proporsi',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Proses menggambar yang paling awal atau membuat rancangan gambar dinamakan ?',
            'correct_answer'=>'Sketsa',
            'answer_b'=>'mewarnai',
            'answer_c'=>'Gambar',
            'answer_d'=>'Batik',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Cat yang memiliki kekuatan tembus pandang warna cemerlang yaitu ?',
            'correct_answer'=>'Transparan water colour',
            'answer_b'=>'cat pastel',
            'answer_c'=>'Pensil warna',
            'answer_d'=>'Water colour',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Contoh karya seni rupa sebagai kebutuhan akan benda pakai yaitu ?',
            'correct_answer'=>'Kursi',
            'answer_b'=>'Foto',
            'answer_c'=>'Lukisan',
            'answer_d'=>'Kaligrafi',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa terapan yaitu karya seni yang lebih mementingkan ?',
            'correct_answer'=>'fungsi pakai dibandingkan keindahan',
            'answer_b'=>'nilai keindahannya',
            'answer_c'=>'keindahan dibangdinkan fungsi pakainya',
            'answer_d'=>'keindahan dibandingkan nilai komersilnya',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Patung yang dibuat dengan tujuan untuk memperingati peristiwa bersejarah, jasa seseorang, kelompok, dinamakan patung ?',
            'correct_answer'=>'Monumen',
            'answer_b'=>'patung mainan',
            'answer_c'=>'Religi',
            'answer_d'=>'Arsitektur',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang mempunyai arti melebih-lebihkan atau mengubah bentuk dinamakan ?',
            'correct_answer'=>'Karikatur',
            'answer_b'=>'Lukisan',
            'answer_c'=>'Kartun',
            'answer_d'=>'Dekoratif',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Corak yang merubah bentuk alam, diubah menurut gagasan, imajinasi, dan kreativitas seniman dinamakan ?',
            'correct_answer'=>'Deformatif',
            'answer_b'=>'Geometris',
            'answer_c'=>'Representatif',
            'answer_d'=>'Abstrak',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang dibuat sesuai keadaan yang sebenarnya baik berdasarkan anatomi atau proposi dinamakan ?',
            'correct_answer'=>'Realis',
            'answer_b'=>'Representatif',
            'answer_c'=>'Ekspresi',
            'answer_d'=>'Komposisi',
            'level_id'=>'11',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);
    }
}
