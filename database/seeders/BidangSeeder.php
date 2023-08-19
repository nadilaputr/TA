<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
                'id' => 1,
                'bidang' => 'Tata Usaha',
            ],
            [
                'id' => 2,
                'bidang' => 'Sekretaris',
            ],
            [
                'id' => 3,
                'bidang' => 'Kepala Dinas',
            ],
            [
                'id' => 4,
                'bidang' => 'Statistik Sosial',
            ],
            [
                'id' => 5,
                'bidang' => 'Statistik Produksi',
            ],
            [
                'id' => 6,
                'bidang' => 'Statistik Distribusi',
            ],
            [
                'id' => 7,
                'bidang' => 'Neraca Wilayah dan Analisis Statistik',
            ],
            [
                'id' => 8,
                'bidang' => 'Integrasi Pengolahan dan Desiminasi Statistik',
            ],
        ];

        foreach ($bidang as $data) {
            Bidang::create($data);
        }
    }
}
