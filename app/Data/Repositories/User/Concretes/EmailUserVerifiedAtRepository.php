<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Infra\Database\DBConnection;
use App\Data\Repositories\User\Interfaces\IEmailUserVerifiedAtRepository;
use App\Exceptions\HttpInternalServerError;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class EmailUserVerifiedAtRepository extends DBConnection implements IEmailUserVerifiedAtRepository
{
    public function emailVerifiedAt(int $id): bool
    {
        try {
            $this->db->beginTransaction();
            User::query()
            ->where('id', '=', $id)
            ->update([
                'email_verificado' => true
            ]);
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
