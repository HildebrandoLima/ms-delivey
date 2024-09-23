<?php

namespace App\Support\Utils\Pagination\Concrete;

use App\Support\Utils\Pagination\Interface\IPagination;

class Pagination implements IPagination
{
    private ?int $page;
    private ?int $perPage;

    public function __construct(?int $page, ?int $perPage)
    {
        $this->page = $page;
        $this->perPage = $perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(?int $page): void
    {
        $this->page = $page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPerPage(?int $perPage): void
    {
        $this->perPage = $perPage;
    }

    public function hasPagination(): bool
    {
        return !empty($this->page) && !empty($this->perPage);
    }
}
