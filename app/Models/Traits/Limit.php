<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait Limit
{
    private function limitToSql(): string
    {
        if ($this->query['limit'] === false) {
            return "";
        }

        return "LIMIT {$this->query['limit']}";
    }

    public function limit(int $limit): self
    {
        $this->query['limit'] = $limit;

        return $this;
    }
}