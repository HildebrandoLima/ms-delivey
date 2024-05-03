<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\Enums\AtivoEnum;
use App\Support\Enums\PerfilEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
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
            'email_verificado' => AtivoEnum::ATIVADO,
            'ativo' => true,
            'role_id' => PerfilEnum::ADMIN,
        ]);
    }
}
