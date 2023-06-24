<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Support\Utils\DefaultDatabaseStatic\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $roles = Roles::ROLES;
        foreach ($roles as $role):
            Role::query()->create([
                'description' => $role['description']
            ]);
        endforeach;
    }
}
