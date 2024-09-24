<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Support\Utils\DefaultDatabaseStatic\RolesDb;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rolesDb = RolesDb::ROLES;
        foreach ($rolesDb as $value) {
            Role::query()->insert([
                'description' => $value['description']
            ]);
        }
    }
}
