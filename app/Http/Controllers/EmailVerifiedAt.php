<?php

namespace App\Http\Controllers;

use App\Exceptions\SystemDefaultException;
use App\Http\Requests\ParametersRequest;
use App\Services\Provider\EmailProviderVerifiedAtService;
use App\Services\User\EmailUserUserVerifiedAtService;
use App\Support\Utils\Parameters\BaseDecode;
use App\Support\Utils\Parameters\FilterByActive;
use Symfony\Component\HttpFoundation\Response;

class EmailVerifiedAt extends Controller
{
    private EmailUserUserVerifiedAtService $emailUserUserVerifiedAtService;
    private EmailProviderVerifiedAtService $emailProviderVerifiedAtService;

    public function __construct
    (
        EmailUserUserVerifiedAtService $emailUserUserVerifiedAtService,
        EmailProviderVerifiedAtService $emailProviderVerifiedAtService
    )
    {
        $this->emailUserUserVerifiedAtService = $emailUserUserVerifiedAtService;
        $this->emailProviderVerifiedAtService = $emailProviderVerifiedAtService;
    }

    public function emailVerifiedAt(string $entity, ParametersRequest $request, BaseDecode $baseDecode, FilterByActive $filterByActive): Response
    {
        try {
            if ($entity == 'user'):
                $success = $this->emailUserUserVerifiedAtService->emailVerifiedAt
                (
                    $baseDecode->baseDecode($request->id ?? ''),
                    $filterByActive->filterByActive($request->active)
                );
            else:
                $success = $this->emailProviderVerifiedAtService->emailVerifiedAt
                (
                    $baseDecode->baseDecode($request->id ?? ''),
                    $filterByActive->filterByActive($request->active)
                );
            endif;
            return $this->success($success);
        } catch(SystemDefaultException $e) {
            return $e->response();
        }
    }

    private function success($success): Response
    {
        if (!isset ($success)):
            return response()->json([
                "message" => "Error ao efetuar verificação!",
                "data" => false,
                "status" => Response::HTTP_UNAUTHORIZED,
                "details" => ""
            ]);
        endif;
        return response()->json([
            "message" => "Verificação efetuada com sucesso!",
            "data" => $success,
            "status" => 200,
            "details" => ""
        ]);
    }
}
