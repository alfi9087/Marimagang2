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
                'id_bidang' => 1,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Santika',
                'email' => 'santika@gmail.com',
                'id_bidang' => 2,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Infras',
                'email' => 'infras@gmail.com',
                'id_bidang' => 3,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Komunikasi',
                'email' => 'komunikasi@gmail.com',
                'id_bidang' => 4,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Stain',
                'email' => 'stain@gmail.com',
                'id_bidang' => 5,
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('bidangs')->insert($bidang);
    }
}
