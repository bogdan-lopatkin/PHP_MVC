<?php

namespace App\Repositories\Product;

use Core\Collection;
use App\Models\AbstractModel;
use App\Models\Product;

interface ProductRepository
{
    public function __construct(Product $productModel);

    /**
     * @return AbstractModel
     */
    public function newQuery();

    public function get(string $sortBy, string $sortType): Collection;

    public function store(Product $product): Product;

    public function show(int $id): Product;
}