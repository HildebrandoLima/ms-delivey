<?php

namespace App\Support\Permissions;

use App\Exceptions\HttpStatusCode\HttpForbidden;

class ValidationPermission
{
    public function validationPermission(string $permission): void
    {
        if(!$this->containsPermission($permission)):
            throw new HttpForbidden();
        endif;
    }

    private function containsPermission(string $permission): bool
    {
        $permissions = auth()->user()->permissions;
        foreach ($permissions->toArray() as $instance):
            if (in_array($permission, $instance)):
                return true;
            endif;
        endforeach;
        return false;
    }
}
