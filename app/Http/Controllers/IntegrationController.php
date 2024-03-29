<?php

namespace App\Http\Controllers;

use App\Domains\Services\Address\Concretes\IntegrationViaCepService;
use App\Exceptions\SystemDefaultException;
use Symfony\Component\HttpFoundation\Response;

class IntegrationController extends Controller
{
    private IntegrationViaCepService $integrationViaCepService;

    public function __construct(IntegrationViaCepService $integrationViaCepService)
    {
        $this->integrationViaCepService = $integrationViaCepService;
    }

    public function show(string $cep): Response
    {
        try {
            $success = $this->integrationViaCepService->integrationViaCep($cep);
            return Controller::get($success);
        } catch (SystemDefaultException $e) {
            return Controller::error($e);
        }
    }
}
