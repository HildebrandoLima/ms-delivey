<?php

namespace App\DataTransferObjects\RequestsDtos;

use App\DataTransferObjects\Dtos\AuthDto;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Str;

class AuthRequestDto
{
    public static function fromRquest(ForgotPasswordRequest $request): AuthDto
    {
        $authDto = new AuthDto();
        $authDto->setEmail($request['email']);
        $authDto->setToken(Str::uuid());
        $authDto->setCodigo(Str::random(10));
        return $authDto;
    }
}
