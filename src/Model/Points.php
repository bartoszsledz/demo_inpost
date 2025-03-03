<?php

namespace App\Model;

class Points
{
    /**
     * @var Point[]
     */
    private array $items;

    public function __construct(
        private int $count,
        private int $page,
        private int $totalPages,
        array $items
    ) {
        $this->items = $items;
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
