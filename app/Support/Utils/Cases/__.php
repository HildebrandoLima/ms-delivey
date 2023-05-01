<?php

namespace App\Support\Utils\Cases;

use App\Support\Utils\Pagination;

class PaginatedList
{
    public ?Pagination $pagination;
    public array $list;

    public function __construct(array $list, ?Pagination $pagination = null)
    {
        $this->list = $list;
        $this->pagination = clone $pagination;
    }

    public static function fromPaginatedQuery($query, Pagination $pagination, ?string $dtoClass = null, callable $mapper = null): static
    {
        $items = $query->toArray()['data'];
        if ($dtoClass) {

            foreach($items as $key => &$row){
                if ($mapper) {
                    $mapper($row);
                }
                $row = (new $dtoClass)->mapFromArray($row);
            }
        }
        $pagination = clone $pagination;
        $pagination->total = $query->total();
        return new self($items, $pagination);
    }
}
