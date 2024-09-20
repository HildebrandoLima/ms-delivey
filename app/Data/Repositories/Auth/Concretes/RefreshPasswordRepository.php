<?php

namespace App\Data\Repositories\Auth\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\Auth\Interfaces\IRefreshPasswordRepository;
use App\Exceptions\HttpInternalServerError;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Hash;
use Exception;

class RefreshPasswordRepository extends DBConnection implements IRefreshPasswordRepository
{
    public function update(int $userId, string $senha): bool
    {
        try {
            $this->db->beginTransaction();
            User::query()
            ->where('id', $userId)
            ->update([
                'password' => Hash::make($senha)
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
