<?php

namespace App\Domains\Traits;

use App\Exceptions\HttpForbidden;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationPermission
{
    public function validationPermission(string $permission): bool
    {
        $user = auth()->user();
        $permissions = $user->permissions();
        $message = 'Permissão negada! Você não possue acesso de administrador.';
        if (in_array($permission, $permissions)): 
            return true;
        endif;
        throw new HttpResponseException(HttpForbidden::getResponse($message));
    }
}
