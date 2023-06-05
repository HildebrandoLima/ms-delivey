<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RefreshPasswordRequest;
use App\Services\Auth\ForgotPasswordService;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use App\Services\Auth\RefreshPasswordService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private ForgotPasswordService $forgotPasswordService;
    private LoginService  $loginService;
    private LogoutService $logoutService;
    private RefreshPasswordService $refreshPasswordService;

    public function __construct
    (
        ForgotPasswordService  $forgotPasswordService,
        LoginService           $loginService,
        LogoutService          $logoutService,
        RefreshPasswordService $refreshPasswordService
    )
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
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

    public function forgotPassword(string $email): Response
    {
        try {
            $success = $this->forgotPasswordService->forgotPassword($email);
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

    public function refreshPassword(RefreshPasswordRequest $request): Response
    {
        try {
            $success = $this->refreshPasswordService->refreshPassword($request);
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
