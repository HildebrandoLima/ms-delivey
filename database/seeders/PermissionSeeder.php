<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Support\Utils\DefaultDatabaseStatic\PermissonsDb;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsDb = PermissonsDb::PEMISSONS;
        foreach ($permissionsDb as $instance):
            Permission::query()->insert([
                'description' => $instance['description']
            ]);
        endforeach;
    }
}
