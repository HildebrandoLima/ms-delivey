<?php

namespace App\Services\Telephone;

use App\Exceptions\HttpBadRequest;
use App\Models\Telefone;
use App\Repositories\TelephoneRepository;
use App\Services\Telephone\Interfaces\IDeleteTelephoneService;
use App\Support\Utils\CheckRegister\CheckTelephone;

class DeleteTelephoneService implements IDeleteTelephoneService
{
    private CheckTelephone $checkTelephone;
    private TelephoneRepository $telephoneRepository;

    public function __construct
    (
        CheckTelephone $checkTelephone,
        TelephoneRepository $telephoneRepository
    )
    {
        $this->checkTelephone = $checkTelephone;
        $this->telephoneRepository = $telephoneRepository;
    }

    public function deleteTelephone(int $id): bool
    {
        $this->checkTelephone->checkTelephoneIdExist($id);
        return $this->telephoneRepository->delete($id);
    }
}
