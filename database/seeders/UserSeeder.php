<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = User::all()->count();
        if ($count > 0):
            User::factory()->create();
        else:
            User::query()->insert([
                'name' => 'Desativado',
                'cpf' => Str::random(11),
                'email' => 'email@email.com.br',
                'password' => Hash::make('123456'),
                'data_nascimento' => new \dateTime(),
                'genero' => 'Outro',
                'ativo' => 0
            ]);
        endif;
    }
}
