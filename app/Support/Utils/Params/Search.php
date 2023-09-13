<?php

namespace App\Support\Utils\Params;

use Illuminate\Http\Request;

final class Search
{
    private string $search;
    private int $id;

    final public function search(Request $request): string|int
    {
        if (!empty($request->id)):
            $request->id === null ? $this->id = 0 : $this->id = $request->id;
            return $this->id;
        endif;

        $request->search === null ? $this->search = '' : $this->search = '%' . $request->search . '%';
        return $this->search;
    }
}
