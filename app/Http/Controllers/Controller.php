<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get($success): Response
    {
        return response()->json([
            "message" => "Listagem efetuada com sucesso.",
            "data" => $success,
            "status" => 200,
            "details" => ""
        ], Response::HTTP_OK);
    }

    public function post($success): Response
    {
        return response()->json([
            "message" => "Cadastro efetuado com sucesso.",
            "data" => $success,
            "status" => 200,
            "details" => ""
        ], Response::HTTP_OK);
    }

    public function put(): Response
    {
        return response()->json([
            "message" => "Edição efetuada com sucesso.",
            "data" => true,
            "status" => 200,
            "details" => ""
        ], Response::HTTP_OK);
    }

    public function delete(): Response
    {
        return response()->json([
            "message" => "Ativação/Desativação efetuada com sucesso.",
            "data" => true,
            "status" => 200,
            "details" => ""
        ], Response::HTTP_OK);
    }

    public function error(): Response
    {
        return response()->json([
            "message" => "Error ao efetuar ação.",
            "data" => false,
            "status" => Response::HTTP_BAD_REQUEST,
            "details" => ""
        ], Response::HTTP_BAD_REQUEST);
    }
}
