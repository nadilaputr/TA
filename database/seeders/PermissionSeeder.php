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

        Permission::create(['name' => 'view surat']);
        Permission::create(['name' => 'view disposisi']);
        Permission::create(['name' => 'create surat']);
        Permission::create(['name' => 'edit surat']);
        Permission::create(['name' => 'edit disposisi']);
        Permission::create(['name' => 'delete surat']);
        Permission::create(['name' => 'delete dataoperator']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'unpublish']);

        $adminRole = Role::create(['name' => 'admin']);
        
        $sekretarisRole = Role::create(['name' => 'sekretaris']);
        $sekretarisRole->givePermissionTo('view surat');
        $sekretarisRole->givePermissionTo('edit disposisi');
        $sekretarisRole->givePermissionTo('delete surat');
        $sekretarisRole->givePermissionTo('publish');
        $sekretarisRole->givePermissionTo('unpublish');
        
        $kepalaDinasRole = Role::create(['name' => 'kepaladinas']);
        $kepalaDinasRole->givePermissionTo('view surat');
        $kepalaDinasRole->givePermissionTo('edit disposisi');
        $kepalaDinasRole->givePermissionTo('publish');

        $kepalaBidangRole = Role::create(['name' => 'kepalabidang']);
        $kepalaBidangRole->givePermissionTo('view surat');
        $kepalaBidangRole->givePermissionTo('edit disposisi');



        $user = User::factory()->create([
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'username' => 'admin',
            'bidang' => 'contohbidang',
            'jabatan' => 'contoh jabatan',
        ]);
        $user->assignRole($adminRole);
        
        $user = User::factory()->create([
            'name' => 'Sekretaris',
            'password' => Hash::make('password'),
            'username' => 'sekretaris',
            'bidang' => 'contohbidang',
            'jabatan' => 'contoh jabatan',
        ]);
        $user->assignRole($sekretarisRole);

        $user = User::factory()->create([
            'name' => 'Kepala Dinas',
            'password' => Hash::make('password'),
            'username' => 'kepaladinas',
            'bidang' => 'contohbidang',
            'jabatan' => 'contoh jabatan',
        ]);
        $user->assignRole($kepalaDinasRole);

        $user = User::factory()->create([
            'name' => 'Kepala Bidang',
            'password' => Hash::make('password'),
            'username' => 'kepalabidang',
            'bidang' => 'contohbidang',
            'jabatan' => 'contoh jabatan',
        ]);
        $user->assignRole($kepalaBidangRole);

     }
}
