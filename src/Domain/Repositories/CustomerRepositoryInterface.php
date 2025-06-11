<?php

declare(strict_types=1);

namespace Domain\Repositories;

use Domain\Entities\Customer;

interface CustomerRepositoryInterface
{
    public function findById(int $id): ?Customer;
    public function save(Customer $customer): void;
    public function findAll(): array;
    public function delete(int $id): void;
}
