<?php

namespace App\Support\Traits;

use App\Support\Utils\Messages\DefaultErrorMessages;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

trait ValidationPermission
{
    public function validationPermission(string $permission): void
    {
        if(!$this->containsPermission($permission)) {
            throw new HttpResponseException
            (
                response()->json([
                    "message" => DefaultErrorMessages::PERMISSION_MESSAGE,
                    "data" => [],
                    "status" => Response::HTTP_FORBIDDEN,
                    "details" => ""
                ], Response::HTTP_FORBIDDEN)
            );
        }
    }

    private function containsPermission(string $permission): bool
    {
        $permissions = auth()->user()->permissions;
        foreach ($permissions->toArray() as $instance) {
            if (in_array($permission, $instance)) {
                return true;
            }
        }
        return false;
    }
}
