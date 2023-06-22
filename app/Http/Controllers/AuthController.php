<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshPasswordRequest;
use App\Services\Auth\Interfaces\ForgotPasswordServiceInterface;
use App\Services\Auth\Interfaces\LoginServiceInterface;
use App\Services\Auth\Interfaces\LogoutServiceInterface;
use App\Services\Auth\Interfaces\RefreshPasswordServiceInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private ForgotPasswordServiceInterface $forgotPasswordService;
    private LoginServiceInterface           $loginService;
    private LogoutServiceInterface          $logoutService;
    private RefreshPasswordServiceInterface $refreshPasswordService;

    public function __construct
    (
        ForgotPasswordServiceInterface  $forgotPasswordService,
        LoginServiceInterface           $loginService,
        LogoutServiceInterface          $logoutService,
        RefreshPasswordServiceInterface $refreshPasswordService
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
                return response()->json([
                    "message" => "Error ao efetuar login!",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Login efetuado com sucesso!",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function logout(): Response
    {
        try {
            $this->logoutService->logout();
            return response()->json([
                "message" => "Logout efetuado com sucesso!",
                "data" => true,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function forgotPassword(ForgotPasswordRequest $request): Response
    {
        try {
            $success = $this->forgotPasswordService->forgotPassword($request);
            if (!isset ($success)):
                return response()->json([
                    "message" => "Error ao efetuar solicitação de nova senha!",
                    "data" => false,
                    "status" => Response::HTTP_BAD_REQUEST,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Solicitação de nova senha efetuada com sucesso!",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function refreshPassword(RefreshPasswordRequest $request, string $token): Response
    {
        try {
            $success = $this->refreshPasswordService->refreshPassword($request, $token);
            if (!isset ($success)):
                return response()->json([
                    "message" => "Error ao modificar senha!",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Senha modificada com sucesso!",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
