<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Product\Product;
use App\Domain\Product\Repository\ProductRepository;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;

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
        return $this->repository
            ->createQueryBuilder('e')
            ->getQuery()
            ->getResult();
    }

    public function findById(Id $id): ?object
    {
        return $this->repository
            ->find($id->getValue());
    }

    /**
     * @param Product $product
     * @return Product
     * @throws Exception
     */
    public function persist(Product $product): Product
    {
        try {
            $this->em->persist($product);
            $this->em->flush();
            return $product;
        } catch (Exception $e) {
            throw new Exception(sprintf('It was not possible to persist given. An error has occurred %s', $e->getMessage()));
        }
    }
}
