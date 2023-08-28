<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $adminRole = Role::create(['name' => 'admin']);
        $sekretarisRole = Role::create(['name' => 'sekretaris']);
        $kepalaDinasRole = Role::create(['name' => 'kepaladinas']);
        $kepalaBidangRole = Role::create(['name' => 'kepalabidang']);

        $user = User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'username' => 'admin',
            'id_bidang' => 1,
            'jabatan' => 'Staff',
        ]);
        $user->assignRole($adminRole);

        $user = User::factory()->create([
            'name' => 'Sekretaris',
            'password' => Hash::make('password'),
            'username' => 'sekretaris',
            'id_bidang' => 2,
            'jabatan' => 'Sekretaris',
        ]);
        $user->assignRole($sekretarisRole);

        $user = User::factory()->create([
            'name' => 'Kepala Dinas',
            'password' => Hash::make('password'),
            'username' => 'kepaladinas',
            'id_bidang' => 3,
            'jabatan' => 'Kepala Dinas',
        ]);
        $user->assignRole($kepalaDinasRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang Statistik Sosial',
            'password' => Hash::make('password'),
            'username' => 'statistiksosial',
            'id_bidang' => 4,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang Statistik Produksi',
            'password' => Hash::make('password'),
            'username' => 'statistikproduksi',
            'id_bidang' => 5,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang Statistik Distribusi',
            'password' => Hash::make('password'),
            'username' => 'statistikdistribusi',
            'id_bidang' => 6,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang Neraca Wilayah dan Analisis Statistik',
            'password' => Hash::make('password'),
            'username' => 'neraca',
            'id_bidang' => 7,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang Integrasi Pengolahan dan Desiminasi Statistik',
            'password' => Hash::make('password'),
            'username' => 'integrasi',
            'id_bidang' => 8,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangRole);

    }
}