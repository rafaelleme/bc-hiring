<?php

namespace App\Infrastructure\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\CarrierConfig;
use App\Domain\Carrier\Repository\CarrierConfigRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @property mixed entity
 * @property EntityRepository repository
 * @property EntityManager em
 */
class DoctrineCarrierConfigRepository implements CarrierConfigRepository
{
    protected $entity = CarrierConfig::class;

    private EntityRepository $repository;

    private EntityManager $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository($this->entity);
    }

    /**
     * @param Carrier $carrier
     * @param float $weight
     * @return CarrierConfig
     * @throws NonUniqueResultException
     */
    public function findByCarrier(Carrier $carrier, float $weight): ?object
    {
        return $this->repository
            ->createQueryBuilder('e')
            ->andWhere('e.carrier = :carrier_id')
            ->andWhere(':weight BETWEEN e.minWeight AND e.maxWeight')
            ->setParameter(':carrier_id', $carrier->getId())
            ->setParameter(':weight', $weight)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
