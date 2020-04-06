<?php

namespace App\Application\Carrier\Service;

use App\Application\Carrier\Request\CarrierRequest;
use App\Domain\Carrier\Carrier;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;

/**
 * @property DoctrineCarrierRepository repository
 */
class CreateCarrierService
{
    private $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CarrierRequest $request): ?Carrier
    {
        $name = $request->getName();
        $fixValue = $request->getFixValue();
        $valueDistanceKilo = $request->getValueDistanceKilo();

        $carrier = new Carrier(
            $name,
            $fixValue,
            $valueDistanceKilo
        );

        $carrier = $this->repository->persist($carrier);

        return $carrier;
    }
}
