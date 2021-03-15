<?php

namespace App\Repositories\Product;


use Core\Collection;
use App\Models\AbstractModel;
use App\Models\Product;

class PdoProductRepository implements ProductRepository
{
    /** @var Product */
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function newQuery(): AbstractModel
    {
        return $this->productModel->newQuery();
    }

    final public function get(string $sortBy, string $sortType): Collection
    {
        if ($sortBy === 'feedbacks') {
            return $this->newQuery()->select('*')->withCount('feedbacks','product_id')
                ->orderBy('feedbacks_count', $sortType)
                ->with('feedbacks')->get();
        }

        return $this->newQuery()->select('*')->orderBy($sortBy, $sortType)->with('feedbacks')->get();
    }

    final public function store(Product $product): Product
    {
        $product->save();

        return $product;
    }

    final public function show(int $id): Product
    {
        return $this->newQuery()->select('*')->where('id', $id)->with('feedbacks')->first();
    }
}