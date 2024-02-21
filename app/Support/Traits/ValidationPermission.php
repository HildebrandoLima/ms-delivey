<?php

namespace App\Support\Traits;

use App\Exceptions\BaseResponseError;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ValidationPermission
{
    public function validationPermission(string $permission): bool
    {
        $message = 'Permissão negada! Você não possue acesso de admin.';
        $permissions = auth()->user()->permissions;
        foreach ($permissions->toArray() as $instance):
            if (in_array($permission, $instance)): 
                return true;
            endif;
        endforeach;
        throw new HttpResponseException(BaseResponseError::httpForbidden($message));
    }
}
