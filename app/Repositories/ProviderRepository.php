<?php

namespace App\Repositories;

use Illuminate\Support\Collection;

class ProviderRepository {
    public function insert(): int
    {
        return 1;
    }

    public function update(): bool
    {
        return true;
    }

    public function delete(): bool
    {
        return true;
    }

    public function getAll(): Collection
    {
        return collect();
    }

    public function getFind(): Collection
    {
        return collect();
    }
}
