<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Databidang;
use App\Models\Skill;
use Illuminate\Support\Facades\DB;

class DataBidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Databidang::truncate();
        Skill::truncate();

        $bidangData = [
            [
                'bidang_id' => '1',
                'nama' => 'Sekretariat',
                'thumbnail' => 'bidang/thumbnails/bidang-sekretariat.jpg',
                'photo' => 'bidang/photos/struktur.jpg',
                'deskripsi' => 'Deskripsi Databidang Sekretariat',
                'status' => 'Buka',
                'kuota' => 5,
            ],
            [
                'bidang_id' => '2',
                'nama' => 'Bidang Aptika',
                'thumbnail' => 'bidang/thumbnails/bidang-aptika.jpg',
                'photo' => 'bidang/photos/struktur.jpg',
                'deskripsi' => 'Deskripsi Databidang Aptika',
                'status' => 'Buka',
                'kuota' => 5,
            ],
            [
                'bidang_id' => '3',
                'nama' => 'Bidang Infrastruktur',
                'thumbnail' => 'bidang/thumbnails/bidang-infrastruktur.jpg',
                'photo' => 'bidang/photos/struktur.jpg',
                'deskripsi' => 'Deskripsi Databidang Infrastruktur',
                'status' => 'Buka',
                'kuota' => 5,
            ],
            [
                'bidang_id' => '4',
                'nama' => 'Bidang Komunikasi',
                'thumbnail' => 'bidang/thumbnails/bidang-komunikasi.jpg',
                'photo' => 'bidang/photos/struktur.jpg',
                'deskripsi' => 'Deskripsi Databidang Komunikasi',
                'status' => 'Buka',
                'kuota' => 5,
            ],
            [
                'bidang_id' => '5',
                'nama' => 'Bidang Statistik',
                'thumbnail' => 'bidang/thumbnails/bidang-statistik.jpg',
                'photo' => 'bidang/photos/struktur.jpg',
                'deskripsi' => 'Deskripsi Databidang Statistik',
                'status' => 'Buka',
                'kuota' => 5,
            ],
        ];

        $skillData = [
            'Pengarsipan dan Input Data',
            'Web dan Aplikasi',
            'Jaringan',
            'Public Speaking dan Presentasi',
            'Pengolahan Data',
        ];

        foreach ($bidangData as $index => $bidang) {
            $databidang = Databidang::create($bidang);

            Skill::create([
                'databidang_id' => $databidang->id,
                'nama' => $skillData[$index],
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
