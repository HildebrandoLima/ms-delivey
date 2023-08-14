<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshPasswordRequest;
use App\Services\Auth\Abstracts\IForgotPasswordService;
use App\Services\Auth\Abstracts\ILoginService;
use App\Services\Auth\Abstracts\ILogoutService;
use App\Services\Auth\Abstracts\IRefreshPasswordService;
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
            if (!isset ($success)):
                return Controller::error();
            endif;
            return response()->json([
                "message" => "Login efetuado com sucesso.",
                "data" => $success,
                "status" =>  Response::HTTP_OK,
                "details" => ""
            ],  Response::HTTP_OK);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function logout(): Response
    {
        try {
            $success = $this->logoutService->logout();
            if ($success):
                return response()->json([
                    "message" => "Logout efetuado com sucesso.",
                    "data" => [],
                    "status" => 200,
                    "details" => ""
                ], Response::HTTP_OK);
            endif;
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): Response
    {
        try {
            $success = $this->forgotPasswordService->forgotPassword($request);
            if (!isset ($success)):
                return Controller::error();
            endif;
            return response()->json([
                "message" => "Solicitação de nova senha efetuada com sucesso.",
                "data" => true,
                "status" => 200,
                "details" => ""
            ], Response::HTTP_OK);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function refreshPassword(RefreshPasswordRequest $request): Response
    {
        try {
            $success = $this->refreshPasswordService->refreshPassword($request);
            if (!isset ($success)):
                return Controller::error();
            endif;
            return response()->json([
                "message" => "Senha modificada com sucesso.",
                "data" => true,
                "status" => Response::HTTP_OK,
                "details" => ""
            ], Response::HTTP_OK);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
