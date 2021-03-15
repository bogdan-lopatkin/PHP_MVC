<?php

namespace App\Models;

use Core\Collection;
use Core\Connection;
use App\Models\Traits\Limit;
use App\Models\Traits\ModelFunctions;
use App\Models\Traits\OrderBy;
use App\Models\Traits\Relations\HasMany;
use App\Models\Traits\Save;
use App\Models\Traits\Select;
use App\Models\Traits\Where;
use App\Models\Traits\With;
use App\Models\Traits\WithCount;
use PDO;

abstract class AbstractModel
{
    use Select,OrderBy,WithCount, Where, HasMany, Limit, Save, ModelFunctions, With;

    private $pdo;

    protected $table = '';

    protected $fillable = [];

    protected $relations;

    private $currentWith;

    private $query;

    private $attributes = [];
    /**
     * @var array
     */
    private $with = [];

    public function __construct(array $attributes = null)
    {
        $this->attributes = $attributes;

        $this->pdo = Connection::getPdo();

        $this->query = [
            'select' => [],
            'wheres' => [],
            'with_count' => [],
            'order_by' => [],
            'limit' => false,
        ];
    }

    public function get()
    {
        $query = null;

        $this->prepareQuery($query);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        $data = $this->dataToModel($data);

        return new Collection($data);
    }

    private function prepareQuery(&$query)
    {
        $sql = "SELECT 
            {$this->getColumns()}
            {$this->withCountToSql()}
            FROM {$this->table} 
            {$this->wheresToSql()} 
            {$this->orderByToSql()} 
            {$this->limitToSql()}";

        $query = $this->pdo->prepare($sql);
        $query->execute($this->getWhereValues());
    }

    public function first()
    {
        $this->query['limit'] = 1;
        $query = null;

        $this->prepareQuery($query);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $this->dataToModel($data[0] ?? [], true);
    }

    /**
     * @param array       $data
     * @param bool        $firstOnly
     * @param string|null $model
     * @return array|AbstractModel
     */
    private function dataToModel(array $data, bool $firstOnly = false, string $model = null)
    {
        if (!$model) {
            $model = get_called_class();
        }

        if ($firstOnly) {
            $resource = new $model($data);

            foreach ($this->with as $relation) {
                $resource->currentWith = $relation;

                $resource->{$relation}();
            }

            return $resource;
        }

        foreach ($data as $key => $resource) {
            $resource = new $model($resource);
            foreach ($this->with as $relation) {
                $resource->currentWith = $relation;
                $resource->{$relation}();
            }
            $data[$key] = $resource;
        }

        return $data;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->relations ?? [])) {
            return $this->relations[$name];
        }

        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        }

        if ($name === 'attributes') {
            return $this->attributes;
        }
    }

    public function __isset($name)
    {
        return array_key_exists($name, $this->attributes) || array_key_exists($name, $this->relations);
    }

    private function getAllowedAttributes(): array
    {
        return array_filter(
            $this->attributes,
            function ($key) {
                return in_array($key, $this->fillable, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    public function newQuery(): self
    {
        $class = get_called_class();

        return new $class;
    }
}