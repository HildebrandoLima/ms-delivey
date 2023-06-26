<?php

namespace App\Support\Permissions;

use App\Exceptions\HttpForbidden;

class ValidationPermission
{
    public function validationPermission(string $permission): void
    {
        if(!$this->containsPermission($permission)):
            throw new HttpForbidden('Você não possue permissão!', false);
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
