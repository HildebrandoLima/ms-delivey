<?php

namespace App\Support\Utils\Params;

use Illuminate\Http\Request;

final class Search
{
    private string $search;

    final public function search(Request $request): string
    {
        $request->search === null ? $this->search = '' : $this->search = '%' . $request->search . '%';
        return $this->search;
    }
}
