<?php

namespace App\Services\Provider;

use App\DataTransferObjects\RequestsDtos\ProviderRequestDto;
use App\Http\Requests\ProviderRequest;
use App\Repositories\CheckRegisterRepository;
use App\Repositories\Interfaces\ProviderRepositoryInterface;
use App\Services\Provider\Interfaces\IEditProviderService;

class EditProviderService implements IEditProviderService
{
    private CheckRegisterRepository     $checkRegisterRepository;
    private ProviderRepositoryInterface $providerRepositoryInterface;

    public function __construct
    (
        CheckRegisterRepository     $checkRegisterRepository,
        ProviderRepositoryInterface $providerRepositoryInterface,
    )
    {
        $this->checkRegisterRepository     = $checkRegisterRepository;
        $this->providerRepositoryInterface = $providerRepositoryInterface;
    }

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->checkRegisterRepository->checkProviderIdExist($id);
        $provider = ProviderRequestDto::fromRquest($request);
        return $this->providerRepositoryInterface->update($id, $provider);
    }
}
