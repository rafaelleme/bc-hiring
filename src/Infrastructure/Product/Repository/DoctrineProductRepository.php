<?php

namespace App\Infrastructure\Product\Repository;

use App\Domain\Product\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @property mixed entity
 * @property EntityManager em
 * @property EntityRepository repository
 */
class DoctrineProductRepository
{
    private $entity = Product::class;

    private $repository;

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entity);
    }
}
