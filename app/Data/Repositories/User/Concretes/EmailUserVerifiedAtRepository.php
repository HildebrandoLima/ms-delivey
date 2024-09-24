<?php

namespace App\Data\Repositories\User\Concretes;

use App\Data\Repositories\User\Interfaces\IEmailUserVerifiedAtRepository;
use App\Exceptions\HttpInternalServerError;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class EmailUserVerifiedAtRepository implements IEmailUserVerifiedAtRepository
{
    public function emailVerifiedAt(int $id): bool
    {
        try {
            DB::beginTransaction();
            User::query()
            ->where('id', '=', $id)
            ->update([
                'email_verificado' => true
            ]);
            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new HttpResponseException(HttpInternalServerError::getResponse($e));
        }
    }
}
