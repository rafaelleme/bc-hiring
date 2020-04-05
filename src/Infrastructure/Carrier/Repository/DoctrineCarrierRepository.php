<?php

namespace App\Infrastructure\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\Repository\CarrierRepository;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\EntityManager;

class DoctrineCarrierRepository implements CarrierRepository
{
    protected $entity = Carrier::class;

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

    public function findById(Id $id): ?Carrier
    {
        // TODO: Implement findById() method.
    }

    public function persist(Carrier $carrier): Carrier
    {
        // TODO: Implement persist() method.
    }
}
