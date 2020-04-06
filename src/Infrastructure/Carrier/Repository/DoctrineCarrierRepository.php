<?php

namespace App\Infrastructure\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\Repository\CarrierRepository;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;

/**
 * @property EntityRepository repository
 * @property EntityManager em
 */
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

    public function persist(Carrier $carrier): Carrier
    {
        try {
            $this->em->persist($carrier);
            $this->em->flush();
            return $carrier;
        } catch (Exception $e) {
            throw new Exception(sprintf('It was not possible to persist given. An error has occurred %s', $e->getMessage()));
        }
    }

    public function remove(Carrier $product): void
    {
        try {
            $this->em->remove($product);
            $this->em->flush();
        } catch (\Throwable $throwable) {
            throw new \Exception($throwable->getMessage());
        }
    }
}
