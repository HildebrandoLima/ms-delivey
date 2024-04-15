<?php

namespace App\Domains\Traits;

use App\Exceptions\HttpForbidden;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationPermission
{
    public function validationPermission(string $permission): bool
    {
        $message = 'Permissão negada! Você não possue acesso de administrador.';
        $permissions = auth()->user()->permissions;
        foreach ($permissions->toArray() as $instance):
            if (in_array($permission, $instance)): 
                return true;
            endif;
        endforeach;
        throw new HttpResponseException(HttpForbidden::getResponse($message));
    }
}
