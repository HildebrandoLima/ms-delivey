<?php

namespace App\Support\Traits;

use App\Support\Utils\DateFormat\DateFormat;

trait DefaultFields
{
    public int $id = 0;
    public ?bool $ativo;
    public ?string $criadoEm;
    public ?string $alteradoEm;

    protected function mapCommonFields(array $data): void
    {
        $this->ativo = $data['ativo'] ?? false;
        $this->criadoEm = DateFormat::dateFormat($data['created_at'] ?? '') ?? '';
        $this->alteradoEm = DateFormat::dateFormat($data['updated_at'] ?? '') ?? '';
    }
}
