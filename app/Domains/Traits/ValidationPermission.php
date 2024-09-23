<?php

namespace App\Domains\Traits;

use App\Exceptions\HttpForbidden;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationPermission
{
    protected function hasPermission(string $permission): bool
    {
        $user = auth()->user();
        $permissions = $user->role->permissions()->where('description', $permission)->exists();
        $message = 'Permissão negada! Você não possue acesso de administrador.';
        if ($permissions) {
            return true;
        }
        throw new HttpResponseException(HttpForbidden::getResponse($message));
    }
}
