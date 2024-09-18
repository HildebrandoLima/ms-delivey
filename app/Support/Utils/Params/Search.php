<?php

namespace App\Support\Utils\Params;

use Illuminate\Http\Request;

class Search
{
    private mixed $search;

    public function __construct(Request $request)
    {
        $this->search = $this->formatSearch($request->search);
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
}
