<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait WithCount
{
    public function withCount(string $relatedTable, string $foreignKey, string $localKey = 'id'): self
    {
        $this->query['with_count'][] = [$relatedTable, $foreignKey, $localKey];

        return $this;
    }

    private function withCountToSql(): string
    {
        $sql = "";
        foreach ($this->query['with_count'] as $withCount) {
            $sql .= "(SELECT count(*) from {$withCount[0]} WHERE {$withCount[0]}.{$withCount[1]} = {$this->table}.{$withCount[2]}) as {$withCount[0]}_count";
        }

        return $sql;
    }
}