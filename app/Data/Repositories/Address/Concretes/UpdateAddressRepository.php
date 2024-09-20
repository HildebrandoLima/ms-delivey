<?php

namespace App\Data\Repositories\Address\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Address\Interfaces\IUpdateAddressRepository;
use App\Domains\Traits\DefaultConditionActive;
use App\Exceptions\HttpInternalServerError;
use App\Models\Endereco;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Exception;

class UpdateAddressRepository extends DBConnection implements IUpdateAddressRepository
{
    use DefaultConditionActive;

    public function update(Request $request): bool
    {
        try {
            $this->db->beginTransaction();
            Endereco::query()
            ->where('id', $request->id)
            ->update([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'bairro' => $request->bairro,
                'cidade' => $request->cidade,
                'cep' => $request->cep,
                'uf' => $request->uf,
                'usuario_id' => $request->usuarioId ?? null,
                'fornecedor_id' => $request->fornecedorId ?? null,
                'ativo' => $this->defaultConditionActive($request->ativo)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
