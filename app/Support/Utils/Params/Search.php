<?php

namespace App\Support\Utils\Params;

use Illuminate\Http\Request;

final class Search
{
    private string|int $search;

    final public function search(Request $request): string|int
    {
        if (is_numeric($request->search)) {
            return $this->search = $request->search;
        } else {
            $request->search === null ? $this->search = '' : $this->search = '%' . $request->search . '%';
            //dd(is_numeric($request->search), $this->search);
            return $this->search;
        }
    }
}
