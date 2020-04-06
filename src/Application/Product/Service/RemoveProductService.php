<?php

namespace App\Application\Product\Service;

use App\Domain\Product\Product;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;

/**
 * @property DoctrineProductRepository repository
 */
class RemoveProductService
{
    private DoctrineProductRepository $repository;

    public function __construct(DoctrineProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Id $id): void
    {
        /** @var Product $product */
        $product = $this->repository->findById($id);

        $this->repository->remove($product);
    }
}
