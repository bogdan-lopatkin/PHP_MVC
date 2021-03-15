<?php


namespace App\Services\Product;


use Core\Collection;
use App\Models\Product;

interface ProductServiceInterface
{
    public function get(string $sortBy, string $sortType): Collection;

    public function store(array $data = []): string;

    public function show(int $id): Product;
}