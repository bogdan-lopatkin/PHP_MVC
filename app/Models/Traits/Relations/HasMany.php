<?php

namespace App\Models\Traits\Relations;


use Core\Connection;
use PDO;

trait HasMany
{
    protected function hasMany(string $relatedModel, string $foreignKey, string $localKey)
    {
        $pdo = Connection::getPdo();
        $relatedTable = (new $relatedModel)->getTable();

        $query = $pdo->prepare("SELECT * from {$relatedTable} where {$foreignKey} = ?");

        $query->execute([$this->{$localKey}]);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $this->relations[$this->currentWith] = $this->dataToModel($data, false, $relatedModel);
    }
}