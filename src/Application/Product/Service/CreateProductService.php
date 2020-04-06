<?php

namespace App\Application\Product\Service;

use App\Application\Product\Request\ProductRequest;
use App\Domain\Product\Product;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;

/**
 * @property DoctrineProductRepository repository
 */
class CreateProductService
{
    private $repository;

    public function __construct(DoctrineProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(ProductRequest $request): ?Product
    {
        $name = $request->getName();
        $weight = $request->getWeight();
        $distance = $request->getDistance();

        $product = new Product(
            $name,
            $weight,
            $distance
        );

        $product = $this->repository->persist($product);

        return $product;
    }
}
