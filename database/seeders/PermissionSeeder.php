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

        // Permission::create(['name' => 'view surat']);
        // Permission::create(['name' => 'view disposisi']);
        // Permission::create(['name' => 'create surat']);
        // Permission::create(['name' => 'edit surat']);
        // Permission::create(['name' => 'edit disposisi']);
        // Permission::create(['name' => 'delete surat']);
        // Permission::create(['name' => 'delete dataoperator']);
        // Permission::create(['name' => 'publish']);
        // Permission::create(['name' => 'unpublish']);

        $adminRole = Role::create(['name' => 'admin']);

        $sekretarisRole = Role::create(['name' => 'sekretaris']);
        // $sekretarisRole->givePermissionTo('view surat');
        // $sekretarisRole->givePermissionTo('edit disposisi');
        // $sekretarisRole->givePermissionTo('delete surat');
        // $sekretarisRole->givePermissionTo('publish');
        // $sekretarisRole->givePermissionTo('unpublish');
        
        $kepalaDinasRole = Role::create(['name' => 'kepaladinas']);
        // $kepalaDinasRole->givePermissionTo('view surat');
        // $kepalaDinasRole->givePermissionTo('edit disposisi');
        // $kepalaDinasRole->givePermissionTo('publish');

        $kepalaBidangStatistikSosialRole = Role::create(['name' => 'Statistik Sosial']);
        $kepalaBidangStatistikProduksiRole = Role::create(['name' => 'Statistik Produksi']);
        $kepalaBidangStatistikDistribusiRole = Role::create(['name' => 'Statistik Distribusi']);
        $kepalaBidangNeracaWilayahAnalisisStatistikRole = Role::create(['name' => 'Neraca Wilayah dan Analisis Statistik']);
        $kepalaBidangIntegrasiPengolahanDanDesiminasiStatistikRole = Role::create(['name' => 'Integrasi Pengolahan dan Desiminasi Statistik']);
        // $kepalaBidangRole->givePermissionTo('view surat');
        // $kepalaBidangRole->givePermissionTo('edit disposisi');



        $user = User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'username' => 'admin',
            'id_bidang' => 1,
            'jabatan' => 'Tata Usaha',
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
            'name' => 'Statistik Sosial',
            'password' => Hash::make('password'),
            'username' => 'statistiksosial',
            'id_bidang' => 4,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangStatistikSosialRole);
        
        $user = User::factory()->create([
            'name' => 'Statistik Produksi',
            'password' => Hash::make('password'),
            'username' => 'statistikproduksi',
            'id_bidang' => 5,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangStatistikProduksiRole);

        $user = User::factory()->create([
            'name' => 'Statistik Distribusi',
            'password' => Hash::make('password'),
            'username' => 'statistikdistribusi',
            'id_bidang' => 6,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangStatistikDistribusiRole);

        $user = User::factory()->create([
            'name' => 'Neraca Wilayah dan Analisis Statistik',
            'password' => Hash::make('password'),
            'username' => 'neraca',
            'id_bidang' => 7,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangNeracaWilayahAnalisisStatistikRole);

        $user = User::factory()->create([
            'name' => 'Integrasi Pengolahan dan Desiminasi Statistik',
            'password' => Hash::make('password'),
            'username' => 'integrasi',
            'id_bidang' => 8,
            'jabatan' => 'Kepala Bidang',
        ]);
        $user->assignRole($kepalaBidangIntegrasiPengolahanDanDesiminasiStatistikRole);

     }
}
