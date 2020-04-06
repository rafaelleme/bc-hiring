<?php

namespace App\Application\Order\Service;

use App\Domain\Order\Cost;
use App\Domain\Order\Exception\InvalidConfigException;
use App\Domain\Order\Order;
use App\Domain\Shared\OrderCollection;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierConfigRepository;
use App\Infrastructure\Order\Repository\DoctrineOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @property DoctrineOrderRepository repository
 * @property DoctrineCarrierConfigRepository ccr
 */
class ListCostService
{
    use OrderCollection;

    private DoctrineOrderRepository $repository;
    private DoctrineCarrierConfigRepository $ccr;

    public function __construct(DoctrineOrderRepository $repository, DoctrineCarrierConfigRepository $ccr)
    {
        $this->repository = $repository;
        $this->ccr = $ccr;
    }

    public function __invoke(): ArrayCollection
    {
        $collect = new ArrayCollection();

        $orders = $this->repository->findAll();

        /** @var Order $order */
        foreach ($orders as $order) {
            $carrier = $order->getCarrier();
            $product = $order->getProduct();

            $config = $this->ccr->findByCarrier($carrier, $product->getWeight());

            if ($config === null) {
                throw new InvalidConfigException('Carrier configuration is invalid to calculation cost.',500);
            }

            $carrier->setConfig($config);

            $cost = $order->calculateCost();

            $collect->add(new Cost(
                $product->getName(),
                $carrier->getName(),
                $cost
            ));
        }

        return $this->orderByAsc($collect, 'getCost');
    }
}
