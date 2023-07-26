<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = ['Admin', 'Sekretaris', 'Kepala Dinas', 'Kepala Bidang'];

        foreach ($role as $name) {
            DB::table('role')->insert([
                'name' => $name
            ]);
        }
    }
}
