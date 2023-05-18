<?php

namespace App\Support\Utils\QueryBuilder;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserQuery {
    public function userQuery(): Builder
    {
        return User::query()->select([
            'id as usuarioId',
            'name as nome',
            'cpf as cpf',
            'email as email',
            'data_nascimento as dataNascimento',
            'genero as genero',
            'ativo as ativo',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ]);
    }
}
