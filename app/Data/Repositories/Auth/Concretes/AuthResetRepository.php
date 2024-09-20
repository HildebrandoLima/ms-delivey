<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Auth\Interfaces\IAuthResetRepository;
use App\Exceptions\HttpInternalServerError;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class AuthResetRepository extends DBConnection implements IAuthResetRepository
{
    public function readCode(string $codigo): int
    {
        return User::query()
        ->join('password_resets as pr', 'pr.email', '=', 'users.email')
        ->select('users.id')->where('pr.codigo', '=', $codigo)->get()->first()->id;
    }

    public function delete(string $codigo): bool
    {
        try {
            $this->db->beginTransaction();
            PasswordReset::query()->where('codigo', '=', $codigo)->delete();
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
