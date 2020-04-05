<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @property mixed entity
 * @property EntityManager em
 * @property EntityRepository repository
 */
class DoctrineProductRepository implements ProductRepository
{
    private $entity = Product::class;

    private $repository;

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entity);
    }

    public function findAll(): ?array
    {
        // TODO: Implement findAll() method.
    }

    public function findById(Id $id): ?Product
    {
        // TODO: Implement findById() method.
    }

    public function persist(Product $product): Product
    {
        // TODO: Implement persist() method.
    }
}
