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
            'level_id'=>'12',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kedudukan struktur tulang dan otot-otot yang menentukan besar kecil dan cekung tubuh manusia dalam bentuk keseluruhan tubuh dinamakan ?',
            'correct_answer'=>'Anatomi',
            'answer_b'=>'Posisi',
            'answer_c'=>'Figuratif',
            'answer_d'=>'Proporsi',
            'level_id'=>'12',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Proses menggambar yang paling awal atau membuat rancangan gambar dinamakan ?',
            'correct_answer'=>'Sketsa',
            'answer_b'=>'mewarnai',
            'answer_c'=>'Gambar',
            'answer_d'=>'Batik',
            'level_id'=>'12',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Cat yang memiliki kekuatan tembus pandang warna cemerlang yaitu ?',
            'correct_answer'=>'Transparan water colour',
            'answer_b'=>'cat pastel',
            'answer_c'=>'Pensil warna',
            'answer_d'=>'Water colour',
            'level_id'=>'12',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Contoh karya seni rupa sebagai kebutuhan akan benda pakai yaitu ?',
            'correct_answer'=>'Kursi',
            'answer_b'=>'Foto',
            'answer_c'=>'Lukisan',
            'answer_d'=>'Kaligrafi',
            'level_id'=>'12',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa terapan yaitu karya seni yang lebih mementingkan ?',
            'correct_answer'=>'fungsi pakai dibandingkan keindahan',
            'answer_b'=>'nilai keindahannya',
            'answer_c'=>'keindahan dibangdinkan fungsi pakainya',
            'answer_d'=>'keindahan dibandingkan nilai komersilnya',
            'level_id'=>'13',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Patung yang dibuat dengan tujuan untuk memperingati peristiwa bersejarah, jasa seseorang, kelompok, dinamakan patung ?',
            'correct_answer'=>'Monumen',
            'answer_b'=>'patung mainan',
            'answer_c'=>'Religi',
            'answer_d'=>'Arsitektur',
            'level_id'=>'13',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang mempunyai arti melebih-lebihkan atau mengubah bentuk dinamakan ?',
            'correct_answer'=>'Karikatur',
            'answer_b'=>'Lukisan',
            'answer_c'=>'Kartun',
            'answer_d'=>'Dekoratif',
            'level_id'=>'13',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Corak yang merubah bentuk alam, diubah menurut gagasan, imajinasi, dan kreativitas seniman dinamakan ?',
            'correct_answer'=>'Deformatif',
            'answer_b'=>'Geometris',
            'answer_c'=>'Representatif',
            'answer_d'=>'Abstrak',
            'level_id'=>'13',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang dibuat sesuai keadaan yang sebenarnya baik berdasarkan anatomi atau proposi dinamakan ?',
            'correct_answer'=>'Realis',
            'answer_b'=>'Representatif',
            'answer_c'=>'Ekspresi',
            'answer_d'=>'Komposisi',
            'level_id'=>'13',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Corak yang merupakan tiruan dari bentuk alam dinamakan ?',
            'correct_answer'=>'Representatif',
            'answer_b'=>'Non geometris',
            'answer_c'=>'Abstrak',
            'answer_d'=>'Deformatif',
            'level_id'=>'14',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Warna yang dihasilkan dari campuran antara warna kuning dan merah yaitu warna ?',
            'correct_answer'=>'Oranye',
            'answer_b'=>'Coklat',
            'answer_c'=>'Hijau',
            'answer_d'=>'Ungu',
            'level_id'=>'14',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Proses pengerjaannya menggunakan dua keping cetakan terbuat dari batu dan dapat dipakai berulang kali sesuai dengan kebutuhan dinamakan teknik ?',
            'correct_answer'=>'Bivalve',
            'answer_b'=>'Mengulir',
            'answer_c'=>'Berputar',
            'answer_d'=>'A cire perdue',
            'level_id'=>'14',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar karikatur pada umumnya mengandung ?',
            'correct_answer'=>'Sindiran atau kritikan',
            'answer_b'=>'saran',
            'answer_c'=>'Mengejek',
            'answer_d'=>'Memuji',
            'level_id'=>'14',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kesan gelap terang suatu benda dapat digambar dengan teknik yang ada di bawah ini, kecuali ?',
            'correct_answer'=>'Teknik linear',
            'answer_b'=>'Teknik blok',
            'answer_c'=>'Teknik dussel',
            'answer_d'=>'Teknik pointilis',
            'level_id'=>'14',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Jenis batik yang motifnya dibuat dengan hanya menggunakan tangan dinamakan ?',
            'correct_answer'=>'Batik tulis',
            'answer_b'=>'Batik Malaysia',
            'answer_c'=>'Batik pekalongan',
            'answer_d'=>'Batik cap',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa yang memiliki panjang dan lebar dinamakan ?',
            'correct_answer'=>'Seni rupa 2 dimensi',
            'answer_b'=>'Seni rupa 3 dimensi',
            'answer_c'=>'Seni rupa terapan',
            'answer_d'=>'Seni rupa murni',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Proses gambar yang dibuat dengan pewarnaan manual atau dengan komputer dengan halus sehigga gambar terlihat seperti aslinya dinamakan gambar ?',
            'correct_answer'=>'Rendering',
            'answer_b'=>'Arsitek',
            'answer_c'=>'Potongan',
            'answer_d'=>'Tembus',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Berikut ini yang termasuk karya seni rupa murni yaitu ?',
            'correct_answer'=>'Patung',
            'answer_b'=>'Cangkir',
            'answer_c'=>'Kursi',
            'answer_d'=>'Rumah',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Di bawah ini yang merupakan contoh karya seni visual dua dimensi yang bergerak, yaitu ?',
            'correct_answer'=>'Film',
            'answer_b'=>'Patung',
            'answer_c'=>'Relief',
            'answer_d'=>'Lukisan',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu jenis karya seni rupa terapan yaitu seni kriya yang disebut juga dengan sebutan ?',
            'correct_answer'=>'Kerajinan tangan',
            'answer_b'=>'Keterampilan',
            'answer_c'=>'Desain',
            'answer_d'=>'Seni grafis',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Di abwah ini adalah unsur dasar seni rupa kecuali ?',
            'correct_answer'=>'Lukisan',
            'answer_b'=>'Ruang',
            'answer_c'=>'Titik',
            'answer_d'=>'Garis',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa yang memiliki panjang, lebar, dan tinggi dinamakan ?',
            'correct_answer'=>'Seni rupa 3 dimensi',
            'answer_b'=>'Seni rupa 2 dimensi',
            'answer_c'=>'Seni rupa terapan',
            'answer_d'=>'Seni rupa murni',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Cabang seni rupa yang menggunakan teknik cetak dalam proses pembuatannya yaitu seni ?',
            'correct_answer'=>'Grafis',
            'answer_b'=>'Relief',
            'answer_c'=>'Lukis',
            'answer_d'=>'Patung',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu cabang seni yang pembuatannya dilakukan dengan cara menggunakan teknik-teknik ukir dinamakan ?',
            'correct_answer'=>'Seni relief',
            'answer_b'=>'Seni fotografi',
            'answer_c'=>'Seni patung',
            'answer_d'=>'Seni grafis',
            'level_id'=>'15',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Unsur fisik seni rupa yang merupakan gabungan titik-titik yang bersambung dinamakan ?',
            'correct_answer'=>'Garis',
            'answer_b'=>'Bidang',
            'answer_c'=>'Warna',
            'answer_d'=>'Volume',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Indra manusia yang digunakan untuk menikmati cabang seni rupa yaitu ?',
            'correct_answer'=>'Penglihatan dan perabaan',
            'answer_b'=>'Pendengaran',
            'answer_c'=>'Perabaan',
            'answer_d'=>'Penglihatan',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Anyaman datar/tunggal dinamakan juga sebagai anyaman ?',
            'correct_answer'=>'Sasak',
            'answer_b'=>'Lilit',
            'answer_c'=>'Bintang',
            'answer_d'=>'Kepang',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Berikut ini yang bukan merupakan teknik yang digunakan untuk menciptakan batik yaitu ?',
            'correct_answer'=>'Butsir',
            'answer_b'=>'Tulis',
            'answer_c'=>'Cetak',
            'answer_d'=>'Printing',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Unsur seni rupa yang dimanfaatkan dalam teknik linear yaitu ?',
            'correct_answer'=>'Garis',
            'answer_b'=>'Ruang',
            'answer_c'=>'Titik',
            'answer_d'=>'Bentuk',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Di bawah ini yang termasuk pasangan benda kubistis-silindris yaitu ?',
            'correct_answer'=>'Layar TV – Botol',
            'answer_b'=>'Layar TV-Kotak Sepatu',
            'answer_c'=>'Botol - Gelas',
            'answer_d'=>'Bola – Telur',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Patung dari bahan lunak pada umumnya menggunakan bahan ?',
            'correct_answer'=>'Tanah liat dan lilin',
            'answer_b'=>'Plastisin dan kayu',
            'answer_c'=>'Plastisin dan batu',
            'answer_d'=>'Kayu dan lilin',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Ukiran yang mengandung simbol-simbol tertentu dan berkaitan dengan kepercayaan untuk kepentingan spiritual termasuk dalam fungsi ?',
            'correct_answer'=>'Magis',
            'answer_b'=>'Ekonomis',
            'answer_c'=>'Hias',
            'answer_d'=>'Konstruksi',
            'level_id'=>'21',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Jenis reklame yang ditayangkan melalui media elektronik dinamakan ?',
            'correct_answer'=>'Iklan',
            'answer_b'=>'Multimedia',
            'answer_c'=>'Pesan dagang',
            'answer_d'=>'Pesan niaga',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang bersumber pada batin / perasaan si penggambar dinamakan gambar ?',
            'correct_answer'=>'Ekspresi',
            'answer_b'=>'Model',
            'answer_c'=>'Imajinasi',
            'answer_d'=>'Estetis',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Garis yang bersudut mampu menciptakan kesan ?',
            'correct_answer'=>'Tajam',
            'answer_b'=>'Stabil',
            'answer_c'=>'Lamban',
            'answer_d'=>'Statis',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gambar yang mempunyai fungsi untuk menghibur karena berisi humor dinamakan ?',
            'correct_answer'=>'Kartun',
            'answer_b'=>'Iklan',
            'answer_c'=>'Karikatur',
            'answer_d'=>'Animasi',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu aliran/gaya seni rupa yang penggambarannya sesuai dengan keadaan jiwa perupanya yang spontan pada saat melihat objek dinamakan ?',
            'correct_answer'=>'Ekspresionisme',
            'answer_b'=>'Kubisme',
            'answer_c'=>'Surealisme',
            'answer_d'=>'Impressionisme',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Gagasan yang dituangkan dalam bentuk gambar untuk dikembangkan lebih lanjut dinamakan ?',
            'correct_answer'=>'Sketsa',
            'answer_b'=>'Karya',
            'answer_c'=>'Kriya',
            'answer_d'=>'Studi',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Setiap hiasan bergaya geometrik atau yang lainnya, yang dibuat pada suatu bentuk dasar dari hasil kerajinan tangan dan arsitektur dinamakan ?',
            'correct_answer'=>'Ornamen',
            'answer_b'=>'Penggambaran',
            'answer_c'=>'Ilustrasi',
            'answer_d'=>'Sampul Buku',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Warna yang dihasilkan dari campuran warna biru dan kuning yaitu adalah warna ?',
            'correct_answer'=>'Hijau',
            'answer_b'=>'Perak',
            'answer_c'=>'Ungu',
            'answer_d'=>'Cokelat',
            'level_id'=>'22',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Media iklan yang ditempelkan di dinding atau tempat tertentu untuk menarik perhatian dinamakan ?',
            'correct_answer'=>'Poster',
            'answer_b'=>'Animasi',
            'answer_c'=>'Kartun',
            'answer_d'=>'Iklan',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Warna yang dihasilkan dari campuran warna merah dan biru yaitu warna ?',
            'correct_answer'=>'Ungu',
            'answer_b'=>'Putih',
            'answer_c'=>'Cokelat',
            'answer_d'=>'Hijau',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Warna yang dihasilkan dari penggabungan warna merah dan kuning dengan perbandingan 50:50 adalah warna ?',
            'correct_answer'=>'Oranye',
            'answer_b'=>'Hijau',
            'answer_c'=>'Ungu',
            'answer_d'=>'Abu-Abu',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Batik yang motifnya dibuat dengan hanya menggunakan tangan disebut ?',
            'correct_answer'=>'Batik tulis',
            'answer_b'=>'Batik cap',
            'answer_c'=>'Batik pekalongan',
            'answer_d'=>'Batik ikat',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Yang termasuk karya seni rupa murni adalah ?',
            'correct_answer'=>'Patung',
            'answer_b'=>'Cangkir',
            'answer_c'=>'Rumah',
            'answer_d'=>'Kursi',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa yang memiliki panjang dan lebar disebut ?',
            'correct_answer'=>'Seni rupa 2 dimensi',
            'answer_b'=>'Seni rupa 3 dimensi',
            'answer_c'=>'Seni rupa murni',
            'answer_d'=>'Seni rupa terapan',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni rupa yang memiliki panjang,lebar, dan tinggi disebut ?',
            'correct_answer'=>'Seni rupa 3 dimensi',
            'answer_b'=>'Seni rupa 2 dimensi',
            'answer_c'=>'Seni rupa murni',
            'answer_d'=>'Seni rupa terapan',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Berikut ini adalah unsur dasar seni rupa kecuali ?',
            'correct_answer'=>'Lukisan',
            'answer_b'=>'Titik',
            'answer_c'=>'Garis',
            'answer_d'=>'Bidang',
            'level_id'=>'23',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Contoh karya seni visual dua dimensi yang bergerak, yaitu ?',
            'correct_answer'=>'Film',
            'answer_b'=>'Relief',
            'answer_c'=>'Lukisan',
            'answer_d'=>'Foto',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Unsur fisik seni rupa yang merupakan gabungan titik-titik yang bersambung, yaitu ?',
            'correct_answer'=>'Garis',
            'answer_b'=>'Warna',
            'answer_c'=>'Volume',
            'answer_d'=>'Tekstur',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu jenis karya seni rupa terapan adalah seni kriya yang disebut juga ?',
            'correct_answer'=>'Kerajinan tangan',
            'answer_b'=>'Desain',
            'answer_c'=>'Seni grafis',
            'answer_d'=>'Arsitektur',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Pelukis yang bernama Vincent van Gogh menganut aliran ?',
            'correct_answer'=>'Ekspresionisme',
            'answer_b'=>'Surealisme',
            'answer_c'=>'Abstraksionisme',
            'answer_d'=>'Realisme',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Salah satu cabang seni rupa dua dimensi dengan proses pembuatan karyanya memakai teknik cetak dan biasanya di atas kertas dinamakan ?',
            'correct_answer'=>'Seni grafis',
            'answer_b'=>'Batik printing',
            'answer_c'=>'Batik',
            'answer_d'=>'Lukisan',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Di bawah ini yang bukan ciri-ciri dari sebuah karya yang beraliran impresionis yaitu  ?',
            'correct_answer'=>'. Garis, bentuk, dan warna ditampilkan tanpa mengindahkan bentuk asli di alam',
            'answer_b'=>'Obyeknya sangat alami',
            'answer_c'=>'Karya cenderung tidak mendetail',
            'answer_d'=>'Karya dibuat tanpa garis penegas',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Yang bukan contoh karya seni rupa dua dimensi yaitu ?',
            'correct_answer'=>'Seni arsitektur',
            'answer_b'=>'Relief',
            'answer_c'=>'Seni lukis',
            'answer_d'=>'Seni grafis',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Suatu karya seni yang dibuat dengan tujuan untuk menjelaskan isi dari tulisan, cerita, puisi, dinamakan seni ?',
            'correct_answer'=>'Ilustrasi',
            'answer_b'=>'Rupa',
            'answer_c'=>'Arsitektur',
            'answer_d'=>'Lukis',
            'level_id'=>'24',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kesan gelap dan terang suatu benda dapat digambar dengan teknik di bawah ini, kecuali ?',
            'correct_answer'=>'Teknik linear',
            'answer_b'=>'Teknik arsir',
            'answer_c'=>'Teknik dussel',
            'answer_d'=>'Teknik pointilis',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Aliran seni yang sangat kebebasan berekspresi, sehingga banyak objek lukisan yang dibuat kontras dengan aslinya menganut aliran ?',
            'correct_answer'=>'Fauvisme',
            'answer_b'=>'Ekspresionisme',
            'answer_c'=>'Impresionisme',
            'answer_d'=>'Surealisme',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Aliran atau gaya seni rupa yang penggambarannya sesuai dengan keadaan jiwa perupanya yang spontan pada saat melihat objek dinamakan ?',
            'correct_answer'=>'Ekspresionisme',
            'answer_b'=>'Realisme',
            'answer_c'=>'Kubisme',
            'answer_d'=>'Impresionisme',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Unsur visual dalam seni rupa 2 dimensi yang terbentuk karena hubungan beberapa garis dinamakan ?',
            'correct_answer'=>'Bidang',
            'answer_b'=>'Barik',
            'answer_c'=>'Bangun',
            'answer_d'=>'Bentuk',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Teknik dalam membuat sebuah karya dengan cara menyambung beberapa potongan bahan merupakan ?',
            'correct_answer'=>'Teknik merakit',
            'answer_b'=>'Teknik cor',
            'answer_c'=>'Teknik cetak',
            'answer_d'=>'Teknik las',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kesan yang ditimbulkan oleh pantulan cahaya pada mata dinamakan ?',
            'correct_answer'=>'Warna',
            'answer_b'=>'Bentuk',
            'answer_c'=>'Tekstur',
            'answer_d'=>'Gelap-terang',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Perbedaan intensitas cahaya yang jatuh pada permukaan benda menyebabkan munculnya tingkat nada warna yang memberi kesan … pada sebuah karya.',
            'correct_answer'=>'Gelap terang',
            'answer_b'=>'Ruang',
            'answer_c'=>'Raut',
            'answer_d'=>'Tekstur',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Campuran salah satu warna primer dengan salah satu warna sekunder menghasilkan warna ?',
            'correct_answer'=>'Tersier',
            'answer_b'=>'Komplementer',
            'answer_c'=>'Analogus',
            'answer_d'=>'Primer',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Di bawah ini yang bukan merupakan cakupan dari komposisi seni rupa yaitu ?',
            'correct_answer'=>'Anatomi',
            'answer_b'=>'Penekanan',
            'answer_c'=>'Kesatuan',
            'answer_d'=>'Keselarasan',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Unsur rupa yang menunjukkan kualitas taktis dari suatu permukaan benda merupakan unsur ?',
            'correct_answer'=>'Barik',
            'answer_b'=>'Raut',
            'answer_c'=>'Garis',
            'answer_d'=>'Bidang',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Penyusunan unsur seni rupa yang tidak ditepatkan secara sama, akan tetapi tetap memperlihatkan kesan keseimbangan artinya ?',
            'correct_answer'=>'Asimetris',
            'answer_b'=>'Keselarasan',
            'answer_c'=>'Proporsi',
            'answer_d'=>'Anatomi',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kesan gerak yang timbul dari penyusunan atau perpaduan unsur-unsur seni dalam sebuah komposisi disebut ?',
            'correct_answer'=>'Irama',
            'answer_b'=>'Proporsi',
            'answer_c'=>'Anatomi',
            'answer_d'=>'Kesatuan',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Kaidah atau prinsip umum yang digunakan untuk menempatkan unsur-unsur fisik dalam sebuah karya seni dinamakan unsur  ?',
            'correct_answer'=>'Non-fisik',
            'answer_b'=>'Fisik',
            'answer_c'=>'Ruang',
            'answer_d'=>'Rupa',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Perantara yang biasa dipakai untuk menyebut berbagai hal yang berhubungan dengan bahan yang dipakai dalam karya seni merupakan ?',
            'correct_answer'=>'Medium',
            'answer_b'=>'Teknik',
            'answer_c'=>'Unsur',
            'answer_d'=>'Alat',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Seni kerajinan yang dikerjakan dengan cara menyilang-nyilangkan bahan merupakan ?',
            'correct_answer'=>'Anyaman',
            'answer_b'=>'Seni kriya',
            'answer_c'=>'Kerajinan tangan',
            'answer_d'=>'Tenunan',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        DB::table('senrup_questions')->insert([
            'question'=>'Sejak terjadinya revolusi Perancis, karya seni bersifat rasional, obyektif, klasik dan dimanfaatkan untuk mendidik merupakan aliran karya seni ?',
            'correct_answer'=>'Neo-klasik',
            'answer_b'=>'Naturalisme',
            'answer_c'=>'Dadaisme',
            'answer_d'=>'Romantisme',
            'level_id'=>'25',
            'created_at'=>\Carbon\Carbon::now(),
            'updated_at'=>\Carbon\Carbon::now()
        ]);

        // DB::table('senrup_questions')->insert([
        //     'question'=>'Dalam seni rupa, garis tipis yang melengkung mampu memberikan kesan ?',
        //     'correct_answer'=>'Ringkih dan lemah',
        //     'answer_b'=>'Bijaksana dan tenang',
        //     'answer_c'=>'Tegas dan bijaksana',
        //     'answer_d'=>'Sabar dan lemah',
        //     'level_id'=>'25',
        //     'created_at'=>\Carbon\Carbon::now(),
        //     'updated_at'=>\Carbon\Carbon::now()
        // ]);

        // DB::table('senrup_questions')->insert([
        //     'question'=>'Teknik melukis khusus yang dilakukan pada media dinding yang masih basah sehingga akan menghasilkan karya yang menyatu dengan design arsiteknya dinamakan teknik ?',
        //     'correct_answer'=>'Tempera',
        //     'answer_b'=>'Arsir',
        //     'answer_c'=>'Aquarel',
        //     'answer_d'=>'Linear',
        //     'level_id'=>'25',
        //     'created_at'=>\Carbon\Carbon::now(),
        //     'updated_at'=>\Carbon\Carbon::now()
        // ]);
    }
}
