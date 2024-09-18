<?php

namespace App\Support\Utils\Pagination;

use Illuminate\Http\Request;

class Pagination
{
    private int $page;
    private int $perPage;

    public function __construct(Request $request)
    {
        $this->page = $request->page;
        $this->perPage = $request->perPage;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    public function setPage(int $page): int
    {
        $this->page = $page;
        return $this->page;
    }

    public function setPerPage(int $perPage): int
    {
        $this->perPage = $perPage;
        return $this->perPage;
    }

    public function hasPagination(): bool
    {
        return !empty($this->page) && !empty($this->perPage);
    }
}
