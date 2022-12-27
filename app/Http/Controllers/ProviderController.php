<?php

namespace App\Http\Controllers;

use App\Http\Requests\Provider\CreateProviderRequest;
use App\Http\Requests\Provider\EditProviderRequest;
use App\Http\Requests\Provider\ProviderRequest;
use App\Services\Provider\CreateProviderService;
use App\Services\Provider\DeleteProviderService;
use App\Services\Provider\EditProviderService;
use App\Services\Provider\ListProviderService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class ProviderController extends Controller
{
    private CreateProviderService   $createProviderService;
    private DeleteProviderService   $deleteProviderService;
    private EditProviderService     $editProviderService;
    private ListProviderService     $listProviderService;

    public function __construct
    (
        CreateProviderService   $createProviderService,
        DeleteProviderService   $deleteProviderService,
        EditProviderService     $editProviderService,
        ListProviderService     $listProviderService
    )
    {
        $this->createProviderService    =   $createProviderService;
        $this->deleteProviderService    =   $deleteProviderService;
        $this->editProviderService      =   $editProviderService;
        $this->listProviderService      =   $listProviderService;
    }

    public function index(ProviderRequest $request): Response
    {
        try {
            $response = isset($request->fornecedorId) || isset($request->fornecedorNome) ? $this->listProviderService->listProviderFind($request) : $this->listProviderService->listProviderAll();
            if($response):
                return response()->json([
                    "message" => "Listagem de fornecedor(s) encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de fornecedor(s).",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateProviderRequest $request): Response
    {
        try {
            $response = $this->createProviderService->createProvider($request);
            if($response):
                return response()->json([
                    "message" => "Cadastro de fornecedor efetuado com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar cadastro de fornecedor.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditProviderRequest $request): Response
    {
        try {
            $response = $this->editProviderService->editProvider($request);
            if($response):
                return response()->json([
                    "message" => "Edição de fornecedor efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar edição de fornecedor.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function destroy(ProviderRequest $request): Response
    {
        try {
            $response = $this->deleteProviderService->deleteProvider($request);
            if($response):
                return response()->json([
                    "message" => "Remoção de fornecedor efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar remoção de fornecedor.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
