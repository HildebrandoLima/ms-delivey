<?php

namespace App\Services\Provider;

use App\Exceptions\HttpBadRequest;
use App\Models\Fornecedor;
use App\Repositories\ProviderRepository;
use App\Services\Provider\Interfaces\IDeleteProviderService;

class DeleteProviderService implements IDeleteProviderService
{
    private ProviderRepository $providerRepository;

    public function __construct(ProviderRepository $providerRepository,)
    {
        $this->providerRepository = $providerRepository;
    }

    public function deleteProvider(int $id): bool
    {
        $this->checkProvider($id);
        return $this->providerRepository->delete($id);
    }

    private function checkProvider(int $id): void
    {
        if (Fornecedor::query()->where('id', $id)->count() == 0):
            throw new HttpBadRequest('O fornecedor não existe');
        endif;
    }
}
