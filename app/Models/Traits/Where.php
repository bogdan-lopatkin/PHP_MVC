<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait Where
{
    private function wheresToSql(): string
    {
        if (empty($this->query['wheres'])) {
            return '';
        }

        $sql = "WHERE ";

        foreach ($this->query['wheres'] as $index => $where) {
            $where[2] = ":where_{$index}";
            $sql .= implode(" ", $where);
        }

        return $sql;
    }

    private function getWhereValues(): array
    {
        $values = [];

        foreach ($this->query['wheres'] as $index => $where) {
            $values["where_{$index}"] = $where[2];
        }

        return $values;
    }

    public function where(string $key, string $operator, string $value = null): self
    {
        if (!$value) {
            $value = $operator;
            $operator = '=';
        }

        $this->query['wheres'][] = [$key, $operator, $value];

        return $this;
    }
}