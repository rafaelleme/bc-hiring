<?php

namespace App\Infrastructure\Order\Repository;

use App\Domain\Order\Order;
use App\Domain\Order\Repository\OrderRepository;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Exception;

/**
 * @property mixed entity
 * @property EntityRepository repository
 * @property EntityManager em
 */
class DoctrineOrderRepository implements OrderRepository
{
    protected $entity = Order::class;

    private EntityRepository $repository;

    private EntityManager $em;

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

    public function persist(Order $order): Order
    {
        try {
            $this->em->persist($order);
            $this->em->flush();
            return $order;
        } catch (Exception $e) {
            throw new Exception(sprintf('It was not possible to persist given. An error has occurred %s', $e->getMessage()));
        }
    }
}
