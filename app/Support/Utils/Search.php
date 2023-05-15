<?php

namespace App\Support\Utils;

class Search
{
    private string $search;

    public function search(string $search): string
    {
        $this->search = $search;
        return '%' . $this->search . '%';
    }
}
