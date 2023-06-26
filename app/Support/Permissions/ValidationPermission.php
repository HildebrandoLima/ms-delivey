<?php

namespace App\Support\Permissions;

use App\Exceptions\HttpForbidden;
use Illuminate\Support\Collection;

class ValidationPermission
{
    private array $arrayPermissions = [];

    public function validationPermission(string $permission): void
    {
        if(!$this->containsPermission($permission)):
            throw new HttpForbidden('Você não possue permissão!', false);
        endif;
    }

    private function containsPermission(string $permission): bool
    {
        $permissions = auth()->user()->permissions;
        if (in_array($permission, $this->arrayPermissions($permissions))):
            return true;
        endif;
        return false;
    }

    private function arrayPermissions(Collection $permissions): array
    {
        foreach ($permissions->toArray() as $instance):
            array_push($this->arrayPermissions, $instance);
        endforeach;
        return $this->arrayPermissions;
    }
}
