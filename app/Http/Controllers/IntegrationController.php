<?php

namespace App\Http\Controllers;

use App\Domains\Services\Address\Interfaces\IIntegrationViaCepService;
use App\Exceptions\HttpBadRequest;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class IntegrationController extends Controller
{
    private IIntegrationViaCepService $integrationViaCepService;

    public function __construct(IIntegrationViaCepService $integrationViaCepService)
    {
        $this->integrationViaCepService = $integrationViaCepService;
    }

    public function show(string $cep): Response
    {
        try {
            $success = $this->integrationViaCepService->integration($cep);
            if (is_null($success)) {
                return HttpBadRequest::getResponse(collect([]), collect([]));
            }
            return Controller::get($success);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }
}
