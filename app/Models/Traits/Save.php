<?php

namespace App\Models\Traits;

use App\Models\AbstractModel;

trait Save
{
    public function save()
    {
        $sql = "INSERT INTO {$this->table} {$this->createInsertQuery()}";
        $request = $this->pdo->prepare($sql);

        $request->execute($this->getAllowedAttributes());
        $this->attributes['id'] = $this->pdo->lastInsertId();
    }

    private function createInsertQuery(): string
    {
        $fields = implode(',', array_keys($this->getAllowedAttributes()));
        $values = implode(',', array_map(function ($item) {
            return ":{$item}";
        }, array_keys($this->getAllowedAttributes())));


        return "({$fields}) VALUES ({$values})";
    }
}