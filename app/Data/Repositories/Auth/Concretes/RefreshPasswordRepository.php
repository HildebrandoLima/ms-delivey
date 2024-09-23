<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Exceptions\HttpInternalServerError;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Exception;

class RefreshPasswordRepository implements IRefreshPasswordRepository
{
    public function update(int $userId, string $senha): bool
    {
        try {
            DB::beginTransaction();
            User::query()
            ->where('id', $userId)
            ->update([
                'password' => Hash::make($senha)
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
