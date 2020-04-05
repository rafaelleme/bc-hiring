<?php

namespace App\Domain\Product\Repository;

interface ProductRepository
{
    public function findAll(): ?array;
    public function findById(): ?object;
}
