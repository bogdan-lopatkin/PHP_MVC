<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait Select
{
    /**
     * @param string|array $columns
     * @return $this
     */
    public function select($columns): self
    {
        if (is_string($columns)) {
            $columns = [$columns];
        }

        $this->query['select'] = $columns;

        return $this;
    }

    private function getColumns(): string
    {
        return implode(',', $this->query['select']) . (count($this->query['with_count']) > 0 ? ',' : '');
    }
}