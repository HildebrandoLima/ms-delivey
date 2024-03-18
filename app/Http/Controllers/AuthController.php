<?php

namespace App\Http\Controllers;

use App\Domains\Services\Auth\Abstracts\IForgotPasswordService;
use App\Domains\Services\Auth\Abstracts\ILoginService;
use App\Domains\Services\Auth\Abstracts\ILogoutService;
use App\Domains\Services\Auth\Abstracts\IRefreshPasswordService;
use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private IForgotPasswordService $forgotPasswordService;
    private ILoginService           $loginService;
    private ILogoutService          $logoutService;
    private IRefreshPasswordService $refreshPasswordService;

    public function __construct
    (
        IForgotPasswordService  $forgotPasswordService,
        ILoginService           $loginService,
        ILogoutService          $logoutService,
        IRefreshPasswordService $refreshPasswordService
    )
    {
        $this->forgotPasswordService  = $forgotPasswordService;
        $this->loginService           = $loginService;
        $this->logoutService          = $logoutService;
        $this->refreshPasswordService = $refreshPasswordService;
    }

    public function login(LoginRequest $request): Response
    {
        try {
            $success = $this->loginService->login($request);
            return response()->json([
                "message" => "Login efetuado com sucesso.",
                "data" => $success,
                "status" =>  Response::HTTP_OK,
                "details" => ""
            ],  Response::HTTP_OK);
        } catch (SystemDefaultException $e) {
            Controller::error($e);
        }
    }

    public function logout(): Response
    {
        try {
            $success = $this->logoutService->logout();
            return response()->json([
                "message" => "Logout efetuado com sucesso.",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ], Response::HTTP_OK);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): Response
    {
        try {
            $success = $this->forgotPasswordService->forgotPassword($request);
            return response()->json([
                "message" => "Solicitação de nova senha efetuada com sucesso.",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ], Response::HTTP_OK);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }

    public function refreshPassword(RefreshPasswordRequest $request): Response
    {
        try {
            $success = $this->refreshPasswordService->refreshPassword($request);
            return response()->json([
                "message" => "Senha modificada com sucesso.",
                "data" => $success,
                "status" => Response::HTTP_OK,
                "details" => ""
            ], Response::HTTP_OK);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
