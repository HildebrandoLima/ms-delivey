<?php

namespace App\Support\Utils\Params\Interface;

interface ISearch
{
    public function getSearch(): mixed;
    public function setSearch(mixed $search): void;
}
