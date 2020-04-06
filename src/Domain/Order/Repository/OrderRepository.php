<?php

namespace App\Domain\Order\Repository;

use App\Domain\Shared\Vo\Id;

interface OrderRepository
{
    public function findAll(): ?array;
    public function findById(Id $id): ?object;
}
