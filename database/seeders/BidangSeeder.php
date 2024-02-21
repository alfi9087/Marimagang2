<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = [
            [
                'nama' => 'Sekretariat',
                'email' => 'sekretariat@gmail.com',
                'password' => Hash::make('passwordku'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Aptika',
                'email' => 'santika@gmail.com',
                'password' => Hash::make('password2'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Infrastruktur',
                'email' => 'infras@gmail.com',
                'password' => Hash::make('password3'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Komunikasi',
                'email' => 'komunikasi@gmail.com',
                'password' => Hash::make('password4'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Statistik',
                'email' => 'stain@gmail.com',
                'password' => Hash::make('password5'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('bidangs')->insert($bidang);
    }
}
