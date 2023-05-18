<?php

namespace App\Services\Provider;

use App\Http\Requests\ProviderRequest;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IEditProviderService;
use App\Support\Utils\CheckRegister\CheckProvider;
use App\Support\Utils\MapToModel\ProviderModel;

class EditProviderService implements IEditProviderService
{
    private CheckProvider $checkProvider;
    private ProviderModel $providerModel;
    private ProviderRepository $providerRepository;

    public function __construct
    (
        CheckProvider      $checkProvider,
        ProviderModel      $providerModel,
        ProviderRepository $providerRepository
    )
    {
        $this->checkProvider      = $checkProvider;
        $this->providerModel      = $providerModel;
        $this->providerRepository = $providerRepository;
    }

    public function editProvider(int $id, ProviderRequest $request): bool
    {
        $this->request = $request;
        $this->checkProvider->checkProviderIdExist($id);
        $provider = $this->providerModel->providerModel($request, 'edit');
        return $this->providerRepository->update($id, $provider);
    }
}
