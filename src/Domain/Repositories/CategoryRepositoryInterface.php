<?php

declare(strict_types=1);

namespace Domain\Repositories;

use Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function findById(int $id): ?Category;
    public function save(Category $category): void;
    public function findAll(): array;
    public function delete(int $id): void;
}
