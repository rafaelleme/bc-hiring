<?php

namespace App\Infrastructure\Shared\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * @property EntityManager em
 * @property EntityRepository repository
 * @property mixed entity
 */
abstract class DoctrineRepository
{
    /** @var EntityManager */
    private $em;

    /** @var EntityRepository */
    protected $repository;

    /** @var mixed */
    private $entity;

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
}
