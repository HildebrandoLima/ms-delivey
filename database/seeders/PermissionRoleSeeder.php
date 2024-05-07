<?php

namespace Database\Seeders;

use App\Models\PermissionRole;
use App\Support\Utils\DefaultDatabaseStatic\PermissonsRolesDb;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsDb = PermissonsRolesDb::PERMISSIONS_ROLES;
        foreach ($permissionsDb as $instance):
            PermissionRole::query()->insert([
                'role_id' => $instance['role_id'],
                'permission_id' => $instance['permission_id'],
            ]);
        endforeach;
    }
}
