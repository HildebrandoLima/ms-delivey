<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Services\Auth\LogoutService;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    private LoginService  $loginService;
    private LogoutService $logoutService;

    public function __construct(LoginService $loginService, LogoutService $logoutService)
    {
        $this->middleware('auth:api', ['except' => ['login']]);
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }

    public function login(LoginRequest $request): Response
    {
        try {
            $success = $this->loginService->login($request);
            if (!isset ($success)):
                return response()->json([
                    "message" => "Error ao efetuar Login!",
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
        //auth()->logout();
        //return response()->json(['message' => 'Successfully logged out']);
    }

    public function refreshPassword()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'accessToken' => $token,
            'userId' => auth()->user()->id,
            'userName' => auth()->user()->name,
            'userEmail' => auth()->user()->email,
        ]);
    }
}
