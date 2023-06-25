<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Support\Utils\DefaultDatabaseStatic\Permissoes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $permissions = Permissoes::PEMISSOES;
        foreach ($permissions as $permission):
            Permission::query()->insert([
                'description' => $permission['description']
            ]);
        endforeach;
    }
}
