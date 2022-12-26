<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\User\CreateUserService;
use App\Services\User\DeleteUserService;
use App\Services\User\EditUserService;
use App\Services\User\ListUserService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private CreateUserService   $createUserService;
    private DeleteUserService   $deleteUserService;
    private EditUserService     $editUserService;
    private ListUserService     $listUserService;

    public function __construct
    (
        CreateUserService   $createUserService,
        DeleteUserService   $deleteUserService,
        EditUserService     $editUserService,
        ListUserService     $listUserService
    )
    {
        $this->createUserService    =   $createUserService;
        $this->deleteUserService    =   $deleteUserService;
        $this->editUserService      =   $editUserService;
        $this->listUserService      =   $listUserService;
    }

    public function index(UserRequest $request): Response
    {
        try {
            $response = isset($request->usuarioId) || isset($request->usuarioNome) ? $this->listUserService->listUserFind($request) : $this->listUserService->listUserAll();
            if($response):
                return response()->json([
                    "message" => "Listagem de usuáiro(s) encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de usuário(s).",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateUserRequest $request): Response
    {
        try {
            $response = $this->createUserService->createUser($request);
            if($response):
                return response()->json([
                    "message" => "Cadastro de usuário efetuado com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar cadastro de usuário.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditUserRequest $request): Response
    {
        try {
            $response = $this->editUserService->editUser($request);
            if($response):
                return response()->json([
                    "message" => "Edição de usuário efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar edição de usuário.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(UserRequest $request): Response
    {
        try {
            $response = $this->deleteUserService->deleteUser($request);
            if($response):
                return response()->json([
                    "message" => "Remoção de usuário efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar remoção de usuário.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
