<?php

namespace App\Application\Product\Service;

use App\Application\Product\Request\ProductRequest;
use App\Domain\Product\Product;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;

/**
 * @property DoctrineProductRepository repository
 */
class UpdateProductService
{
    private DoctrineProductRepository $repository;

    public function __construct(DoctrineProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id, ProductRequest $request): ?Product
    {
        /** @var Product $product */
        $product = $this->repository->findById(new Id($id));

        $name = $request->getName();
        $weight = $request->getWeight();

        $product->setName($name);
        $product->setWeight($weight);

        return $this->repository->persist($product);
    }
}
