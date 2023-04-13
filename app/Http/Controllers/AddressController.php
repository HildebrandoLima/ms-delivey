<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Address\EditAddressRequest;
use App\Services\Address\CreateAddressService;
use App\Services\Address\EditAddressService;
use App\Services\Address\ListAddressService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    private CreateAddressService      $createAddressService;
    private EditAddressService        $editAddressService;
    private ListAddressService        $listAddressService;

    public function __construct
    (
        CreateAddressService      $createAddressService,
        EditAddressService        $editAddressService,
        ListAddressService        $listAddressService
    )
    {
        $this->createAddressService      =   $createAddressService;
        $this->editAddressService        =   $editAddressService;
        $this->listAddressService        =   $listAddressService;
    }

    public function uf(): Response
    {
        try {
            $response = $this->listAddressService->listFederativeUnitAll();
            if($response):
                return response()->json([
                    "message" => "Listagem de uf encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de uf.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function index(int $userId): Response
    {
        try {
            $response = $this->listAddressService->listAddressAll($userId);
            if($response):
                return response()->json([
                    "message" => "Listagem de endereço encontrada com sucesso.",
                    "data" => $response,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao buscar listagem de endereço.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function store(CreateAddressRequest $request): Response
    {
        try {
            $response = $this->createAddressService->createAddress($request);
            if($response):
                return response()->json([
                    "message" => "Cadastro de endereço efetuado com sucesso.",
                    "data" => "true",
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar cadastro de endereço.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    public function update(EditAddressRequest $request): Response
    {
        try {
            $response = $this->editAddressService->editAddress($request);
            if($response):
                return response()->json([
                    "message" => "Edição de endereço efetuado com sucesso.",
                    "data" => true,
                    "status" => 200,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Error ao efetuar edição de endereço.",
                "data" => false,
                "status" => Response::HTTP_BAD_REQUEST,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }
}
