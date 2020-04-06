<?php

namespace App\Application\Carrier\Service;

use App\Domain\Carrier\Carrier;
use App\Domain\Product\Product;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;
use App\Infrastructure\Product\Repository\DoctrineProductRepository;

/**
 * @property DoctrineCarrierRepository carrierRepository
 * @property DoctrineProductRepository productRepository
 */
class ListCostService
{
    private DoctrineCarrierRepository $carrierRepository;
    private DoctrineProductRepository $productRepository;

    public function __construct(
        DoctrineCarrierRepository $carrierRepository,
        DoctrineProductRepository $productRepository
    )
    {
        $this->carrierRepository = $carrierRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        $result = [];

        /** @var array $carriers */
        $carriers = $this->carrierRepository->findAll();

        /** @var array $products */
        $products = $this->productRepository->findAll();

         /** @var Carrier $carrier */
         /** @var Product $product */
        foreach ($carriers as $carrier) {
            foreach ($products as $product) {
                $cost = $carrier->calculateCost($product);

                $result[] = [
                    'carrier' => $carrier->getName(),
                    'product' => $product->getName(),
                    'cost' => $cost
                ];
            }
        }

        return $result;
    }
}
