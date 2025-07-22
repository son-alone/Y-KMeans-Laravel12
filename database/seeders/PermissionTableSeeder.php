<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'provinsi-list',
            'provinsi-create',
            'provinsi-edit',
            'provinsi-delete',
            'prodi-list',
            'prodi-create',
            'prodi-edit',
            'prodi-delete',
            'pt-list',
            'pt-create',
            'pt-edit',
            'pt-delete',
            'ptprodi-list',
            'ptprodi-create',
            'ptprodi-edit',
            'ptprodi-delete',
            'batch-list',
            'batch-create',
            'batch-edit',
            'batch-delete',
            'yudisium-list',
            'yudisium-verifikasi',
            'yudisium-create',
            'yudisium-edit',
            'yudisium-download',
            'yudisium-delete',
            'detail-list',
            'detail-import',
            'detail-template',
            'detail-create',
            'detail-edit',
            'detail-delete',
            'clustering-list',
            'clustering-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
