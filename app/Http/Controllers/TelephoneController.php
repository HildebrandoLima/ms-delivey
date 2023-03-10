<?php

namespace App\Http\Controllers;

use App\Http\Requests\Telephone\CreateTelephoneRequest;
use App\Http\Requests\Telephone\EditTelephoneRequest;
use App\Services\Telephone\CreateTelephoneService;
use App\Services\Telephone\EditTelephoneService;
use App\Services\Telephone\ListDDDService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class TelephoneController extends Controller
{
    private CreateTelephoneService $createTelephoneService;
    private EditTelephoneService   $editTelephoneService;
    private ListDDDService         $listDDDService;

    public function __construct
    (
        CreateTelephoneService    $createTelephoneService,
        EditTelephoneService      $editTelephoneService,
        ListDDDService            $listDDDService
    )
    {
        $this->createTelephoneService    =   $createTelephoneService;
        $this->editTelephoneService      =   $editTelephoneService;
        $this->listDDDService            =   $listDDDService;
    }

    public function index(): Response
    {
        try {
            $response = $this->listDDDService->listDDDAll();
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
                    "message" => "Edi????o de telefone efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar edi????o de telefone.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
