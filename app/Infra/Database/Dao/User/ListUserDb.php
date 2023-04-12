<?php

namespace App\Infra\Database\Dao\User;

use App\Http\Requests\User\UserRequest;
use App\Infra\Database\Config\DbBase;
use Illuminate\Support\Collection;

class ListUserDb extends DbBase
{
    public function listUserAll(): Collection
    {
        return $this->db
        ->table('users')
        ->select([
            'id as usuarioId',
            'name as nome',
            'ativo as atividade',
            'genero as genero',
            'created_at as criadoEm',
            'updated_at as alteradoEm'
        ])
        ->orderBy('id')
        ->get();
    }

    public function listUserFind(UserRequest $request): Collection
    {
        $query = $this->db
        ->table('users as u')
        ->select([
            'u.id as usuarioId',
            'u.name as nome',
            'u.ativo as atividade',
            'u.genero as genero',
            'u.created_at as criadoEm',
            'u.updated_at as alteradoEm'
        ]);
        if (isset($request->usuarioId)):
            $query->where('id', $request->usuarioId);
        endif;

        if (isset($request->usuarioNome)):
            $query->where('name', 'like', '%' . $request->usuarioNome . '%');
        endif;
        return $query->get();
    }
}
