<?php

namespace App\Services\Provider;

use App\Http\Requests\Provider\EditProviderRequest;
use App\Support\Utils\Cases\ActivityCase;
use App\Infra\Database\Dao\Provider\EditProviderDb;

class EditProviderService
{
    private ActivityCase   $activityCase;
    private EditProviderDb $editProviderDb;

    public function __construct
    (
        ActivityCase   $activityCase,
        EditProviderDb $editProviderDb
    )
    {
        $this->activityCase   = $activityCase;
        $this->editProviderDb = $editProviderDb;
    }

    public function editProvider(EditProviderRequest $request): bool
    {
        $atividade = $this->activityCase->activityCase($request->atividade);
        return $this->editProviderDb->editProvider($request, $atividade);
    }
}
