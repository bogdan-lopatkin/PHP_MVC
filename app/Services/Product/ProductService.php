<?php


namespace App\Services\Product;


use Core\Collection;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;

class ProductService
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    final public function get(string $sortBy, string $sortType): Collection
    {
        return $this->productRepository->get($sortBy, $sortType);
    }

    final public function store(array $data = []): string
    {
        $product = new Product($data);
        $product = $this->productRepository->store($product);

        return json_encode($product->toArray());
    }

    final public function show(int $id): Product
    {
        return $this->productRepository->show($id);
    }
}