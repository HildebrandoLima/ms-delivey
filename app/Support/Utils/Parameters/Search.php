<?php

namespace App\Support\Utils\Parameters;

class Search
{
    private string $search;

    public function search(string $search): string
    {
        $search == '' ? $this->search = '' : $this->search = '%' . $search . '%';
        return $this->search;
    }
}
