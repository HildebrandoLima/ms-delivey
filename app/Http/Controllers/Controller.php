<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpInternalServerError;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class Controller extends BaseController
{
    public function get(Collection $success): Response
    {
        return response()->json([
            "message" => "Listagem efetuada com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function post(int $success): Response
    {
        return response()->json([
            "message" => "Cadastro efetuado com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function put(bool $success): Response
    {
        return response()->json([
            "message" => "Edição efetuada com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function delete(): Response
    {
        return response()->json([
            "message" => "Ativação/Desativação efetuada com sucesso.",
            "data" => [],
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function error(Exception $details): Response
    {
        throw new HttpResponseException(HttpInternalServerError::getResponse($details));
    }
}
