<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait OrderBy
{
    private function orderByToSql(): string
    {
        if (count($this->query['order_by']) === 0) {
            return "";
        }

        $sql = "";
        foreach ($this->query['order_by'] as $orderBy) {
            $sql .= "ORDER BY {$orderBy[0]} {$orderBy[1]}";
        }

        return $sql;
    }

    public function orderBy(string $orderBy, string $orderType): self
    {
        $this->query['order_by'][] = [$orderBy, $orderType];

        return $this;
    }
}