<?php

namespace Core;

class Collection
{
    private $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return array_map(static function ($item) {
            return $item->attributes;
        },$this->items);
    }
}