<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Product\Product;
use App\Infrastructure\Shared\Repository\DoctrineRepository;

class DoctrineProductRepository extends DoctrineRepository
{
    protected $entity = Product::class;
}
