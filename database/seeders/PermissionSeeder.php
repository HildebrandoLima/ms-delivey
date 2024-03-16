<?php

namespace Database\Seeders;

use App\Domains\Models\Permission;
use App\Support\Utils\DefaultDatabaseStatic\PermissoesDb;
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
        $permissionsDb = PermissoesDb::PEMISSOES;
        foreach ($permissionsDb as $instance):
            Permission::query()->insert([
                'description' => $instance['description']
            ]);
        endforeach;
    }
}
