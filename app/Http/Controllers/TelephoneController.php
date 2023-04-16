<?php

namespace App\Http\Controllers;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Http\Requests\Telephone\TelephoneRequest;
use App\Http\Requests\User\UserRequest;
use App\Services\Telephone\CreateTelephoneService;
use App\Services\Telephone\DeleteTelephoneService;
use App\Services\Telephone\EditTelephoneService;
use App\Services\Telephone\ListTelephoneService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private CreateTelephoneService $createTelephoneService;
    private DeleteTelephoneService $deleteTelephoneService;
    private EditTelephoneService   $editTelephoneService;
    private ListTelephoneService   $listTelephoneService;

    public function __construct
    (
        CreateTelephoneService    $createTelephoneService,
        DeleteTelephoneService    $deleteTelephoneService,
        EditTelephoneService      $editTelephoneService,
        ListTelephoneService      $listTelephoneService
    )
    {
        $this->createTelephoneService    =   $createTelephoneService;
        $this->deleteTelephoneService    =   $deleteTelephoneService;
        $this->editTelephoneService      =   $editTelephoneService;
        $this->listTelephoneService      =   $listTelephoneService;
    }

    public function ddd(): Response
    {
        try {
            $response = $this->listTelephoneService->listDDDAll();
            if($response):
                return response()->json([
                    "message" => "Listagem de ddd encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de ddd.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function index(UserRequest $request): Response
    {
        try {
            $response = $this->listTelephoneService->listTelephoneAll($request);
            if($response):
                return response()->json([
                    "message" => "Listagem de telefone encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de telefone.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateTelephoneRequest $request): Response
    {
        try {
            $response = $this->createTelephoneService->createTelephone($request);
            if($response):
                return response()->json([
                    "message" => "Cadastro de telefone efetuado com sucesso.",
                    "data" => "true",
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar cadastro de telefone.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditTelephoneRequest $request): Response
    {
        try {
            $response = $this->editTelephoneService->editTelephone($request);
            if($response):
                return response()->json([
                    "message" => "Edição de telefone efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar edição de telefone.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(TelephoneRequest $request): Response
    {
        try {
            $response = $this->deleteTelephoneService->deleteTelephone($request);
            if($response):
                return response()->json([
                    "message" => "Remoção do telefone efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar remoção de telefone.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
