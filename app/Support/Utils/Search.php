<?php

namespace App\Support\Utils;

use Illuminate\Http\Request;

class Search
{
    private string $search;
    private int $id;

    public function search(Request $request): string
    {
        $this->search = $request->search ?? '';
        return '%' . $this->search . '%';
    }

    public function id(string $id): int
    {
        $this->id = base64_decode($id);
        return $this->id;
    }
}
