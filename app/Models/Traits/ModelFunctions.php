<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait ModelFunctions
{
    public function toArray(): array
    {
        return $this->attributes;
    }

    public function getTable(): string
    {
        return $this->table;
    }
}