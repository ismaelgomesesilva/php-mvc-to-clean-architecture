<?php

declare(strict_types=1);

namespace Domain\Repositories;

use Domain\Entities\Product;

interface ProductRepositoryInterface
{
    public function findById(int $id): ?Product;
    public function save(Product $product): void;
    public function findAll(): array;
    public function delete(int $id): void;
}
