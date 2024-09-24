<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IForgotPasswordRepository;
use App\Exceptions\HttpInternalServerError;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Models\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class ForgotPasswordRepository implements IForgotPasswordRepository
{
    public function create(ForgotPasswordRequest $request): int
    {
        try {
            DB::beginTransaction();
            $id = PasswordReset::query()->create([
                'email' => $request->email,
                'token' => Str::uuid(),
                'codigo' => Str::random(10)
            ])->orderBy('id', 'desc')->first()->id;
            DB::commit();
            return $id;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
