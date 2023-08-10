<?php

namespace App\Http\Controllers;

use App\Exceptions\HttpStatusCode\HttpBadRequest;
use App\Exceptions\SystemDefaultException;
use App\Services\AuthSocial\Interfaces\HandleProviderCallbackServiceInterface;
use App\Services\AuthSocial\Interfaces\RedirectToProviderServiceInterface;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthSocialController extends Controller
{
    private RedirectToProviderServiceInterface     $redirectToProviderService;
    private HandleProviderCallbackServiceInterface $handleProviderCallbackService;

    public function __construct
    (
        RedirectToProviderServiceInterface     $redirectToProviderService,
        HandleProviderCallbackServiceInterface $handleProviderCallbackService
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

    public function handleProviderCallback($provider): Response
    {
        try {
            $this->validateProvider($provider);
            $success = $this->handleProviderCallbackService->handleProviderCallback($provider);
            if (!isset ($success)):
                return response()->json([
                    "message" => "Error ao efetuar login!",
                    "data" => false,
                    "status" => Response::HTTP_UNAUTHORIZED,
                    "details" => ""
                ]);
            endif;
            return response()->json([
                "message" => "Login efetuado com sucesso!",
                "data" => $success,
                "status" => 200,
                "details" => ""
            ]);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    private function validateProvider(string $provider): void
    {
        if (!in_array($provider, ['facebook', 'google', 'github'])):
            throw new HttpBadRequest('Por favor, faça login usando o Facebook, GitHub ou Google!');
        endif;
    }
}
