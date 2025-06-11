<?php

declare(strict_types=1);

namespace Domain\Repositories;

use Domain\Entities\Transaction;

interface TransactionRepositoryInterface
{
    public function findById(int $id): ?array;

    public function save(Transaction $transaction): void;

    public function findAll(): array;

    public function delete(int $id): void;

    public function findByCustomerId(int $customerId): array;

    public function findByProductId(int $productId): array;
}
