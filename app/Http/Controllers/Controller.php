<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get(Collection $success): Response
    {
        return response()->json([
            "message" => "Listagem efetuada com sucesso.",
            "data" => $success,
            "status" => Response::HTTP_OK,
            "details" => "",
        ], Response::HTTP_OK);
    }

    public function post(bool $success): Response
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
        Log::error("Error: [" . $details->getMessage() . "]");
        return response()->json([
            "message" => "Error ao efetuar ação.",
            "data" => [],
            "status" => Response::HTTP_BAD_REQUEST,
            "details" => $details->getMessage(),
        ], Response::HTTP_BAD_REQUEST);
    }
}
