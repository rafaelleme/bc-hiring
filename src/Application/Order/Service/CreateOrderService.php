<?php

namespace App\Application\Order\Service;

use App\Application\Order\Request\OrderRequest;
use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\Exception\CarrierNotFoundException;
use App\Domain\Order\Order;
use App\Domain\Product\Exception\ProductNotFoundException;
use App\Domain\Product\Product;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;
use App\Infrastructure\Order\Repository\DoctrineOrderRepository;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;

class CreateOrderService
{
    private DoctrineOrderRepository $orderRepository;
    private DoctrineCarrierRepository $carrierRepository;
    private DoctrineProductRepository $productRepository;

    public function __construct(
        DoctrineOrderRepository $orderRepository,
        DoctrineCarrierRepository $carrierRepository,
        DoctrineProductRepository $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->carrierRepository = $carrierRepository;
        $this->productRepository = $productRepository;
    }

    public function __invoke(OrderRequest $request)
    {
        $distance = $request->getDistance();
        /** @var Carrier $carrier */
        $carrier = $this->carrierRepository->findById(new Id($request->getCarrier()));

        if ($carrier === null)
            throw new CarrierNotFoundException('The carrier was not found.',404);

        /** @var Product $product */
        $product = $this->productRepository->findById(new Id($request->getProduct()));

        if ($product === null)
            throw new ProductNotFoundException('The product was not found.',404);

        $order = new Order(
            $distance,
            $carrier,
            $product
        );

        $order = $this->orderRepository->persist($order);

        return $order;
    }
}
