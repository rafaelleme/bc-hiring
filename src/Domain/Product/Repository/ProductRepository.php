<?php

namespace App\Domain\Product\Repository;

use App\Domain\Product\Product;
use App\Domain\Shared\Vo\Id;

interface ProductRepository
{
    public function findAll(): ?array;
    public function findById(Id $id): ?Product;
    public function persist(Product $product): Product;
}
