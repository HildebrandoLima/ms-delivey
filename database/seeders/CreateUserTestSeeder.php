<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Enums\ActiveEnum;
use App\Support\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'nome' => 'Hill',
            'cpf' => '305.023.110-61',
            'email' => 'hildebrandolima16@gmail.com',
            'password' => Hash::make('HiLd3br@ndo'),
            'data_nascimento' => date('Y-m-d H:i:s'),
            'genero' => 'Outro',
            'email_verificado' => true,
            'ativo' => ActiveEnum::ATIVADO,
            'role_id' => RoleEnum::ADMIN,
        ]);

        User::query()->create([
            'nome' => 'Client',
            'cpf' => '167.934.740-30',
            'email' => 'cliente@gmail.com',
            'password' => Hash::make('@PClient5'),
            'data_nascimento' => date('Y-m-d H:i:s'),
            'genero' => 'Outro',
            'email_verificado' => true,
            'ativo' => ActiveEnum::ATIVADO,
            'role_id' => RoleEnum::CLIENTE,
        ]);
    }
}
