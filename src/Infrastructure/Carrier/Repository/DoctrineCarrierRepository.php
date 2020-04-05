<?php

namespace App\Infrastructure\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use Doctrine\ORM\EntityManager;

class DoctrineCarrierRepository
{
    protected $entity = Carrier::class;

    private $repository;

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entity);
    }
}
