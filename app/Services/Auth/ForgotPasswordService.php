<?php

namespace App\Services\Auth;

use App\Http\Requests\ForgotPasswordRequest;
use App\Jobs\ForgotPassword;
use App\Models\PasswordReset;
use App\Repositories\AuthRepositoy;
use App\Services\Auth\Interfaces\IForgotPasswordService;
use Illuminate\Support\Str;

class ForgotPasswordService implements IForgotPasswordService
{
    private AuthRepositoy $authRepositoy;

    public function __construct(AuthRepositoy $authRepositoy)
    {
        $this->authRepositoy = $authRepositoy;
    }

    public function forgotPassword(ForgotPasswordRequest $request): bool
    {
        $passwordReset = $this->mapToModel($request->email);
        if ($this->authRepositoy->forgotPassword($passwordReset)):
            ForgotPassword::dispatch($passwordReset->email, $passwordReset->codigo);
            return true;
        else:
            return false;
        endif;
    }

    private function mapToModel(string $email): PasswordReset
    {
        $passwordReset = new PasswordReset();
        $passwordReset->codigo = Str::random(10);
        $passwordReset->email = $email;
        return $passwordReset;
    }
}
