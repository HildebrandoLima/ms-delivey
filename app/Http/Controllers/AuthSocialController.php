<?php

namespace App\Http\Controllers;

use App\Domains\Services\AuthSocial\Interfaces\IHandleProviderCallbackService;
use App\Domains\Services\AuthSocial\Interfaces\IRedirectToProviderService;
use App\Exceptions\HttpBadRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class AuthSocialController extends Controller
{
    private IRedirectToProviderService     $redirectToProviderService;
    private IHandleProviderCallbackService $handleProviderCallbackService;

    public function __construct
    (
        IRedirectToProviderService     $redirectToProviderService,
        IHandleProviderCallbackService $handleProviderCallbackService
    )
    {
        $this->redirectToProviderService     = $redirectToProviderService;
        $this->handleProviderCallbackService = $handleProviderCallbackService;
    }

    public function redirectToProvider(string $provider): RedirectResponse
    {
        $this->validateProvider($provider);
        return $this->redirectToProviderService->redirectToProvider($provider);
    }

    public function handleProviderCallback(string $provider): Response
    {
        try {
            $this->validateProvider($provider);
            $success = $this->handleProviderCallbackService->handleProviderCallback($provider);
            if (!isset($success)) {
                return response()->json([
                    "message" => "Error ao efetuar login!",
                    "data" => [],
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ], Response::HTTP_UNAUTHORIZED);
            }
            return response()->json([
                "message" => "Login efetuado com sucesso!",
                "data" => $success,
                "status" => Response::HTTP_OK,
                "details" => ""
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return Controller::error($e);
        }
    }

    private function validateProvider(string $provider): void
    {
        if (!in_array($provider, ['facebook', 'google', 'github'])) {
            throw new HttpResponseException(HttpBadRequest::getResponse(collect(),
            collect([
                'Informe umas das seguintes redes sociais: Facebook, Google ou GitHub.'
            ])));
        }
    }
}
