<?php

namespace App\Support\Utils;

class Search
{
    private string $search;
    private int $id;

    public function search(): string
    {
        return '%' . $this->search . '%';
    }

    public function id(string $id): int
    {
        $this->id = base64_decode($id);
        return $this->id;
    }
}
