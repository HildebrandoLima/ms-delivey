<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class ForgotPasswordRepository extends DBConnection implements IForgotPasswordRepository
{
    public function create(ForgotPasswordRequest $request): int
    {
        try {
            $this->db->beginTransaction();
            $id = PasswordReset::query()->create([
                'email' => $request->email,
                'token' => Str::uuid(),
                'codigo' => Str::random(10)
            ])->orderBy('id', 'desc')->first()->id;
            $this->db->commit();
            return $id;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
