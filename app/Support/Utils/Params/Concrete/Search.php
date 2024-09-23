<?php

namespace App\Support\Utils\Params\Concrete;

use App\Support\Utils\Params\Interface\ISearch;

class Search implements ISearch
{
    private mixed $search;

    public function __construct(mixed $search)
    {
        $this->search = $this->formatSearch($search);
    }

    private function formatSearch(mixed $search): mixed
    {
        if (is_numeric($search)) {
            return $search;
        } else {
            return $search === null ? '' : '%' . $search . '%';
        }
    }

    public function getSearch(): mixed
    {
        return $this->search;
    }

    public function setSearch(mixed $search): void
    {
        $this->search = $this->formatSearch($search);
    }
}
