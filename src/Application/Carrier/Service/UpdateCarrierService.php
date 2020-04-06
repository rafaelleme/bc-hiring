<?php

namespace App\Application\Carrier\Service;

use App\Application\Carrier\Request\CarrierRequest;
use App\Domain\Carrier\Carrier;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;

/**
 * @property DoctrineCarrierRepository repository
 */
class UpdateCarrierService
{
    private $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id, CarrierRequest $request): ?Carrier
    {
        /** @var Carrier $carrier */
        $carrier = $this->repository->findById(new Id($id));

        $name = $request->getName();
        $fixValue = $request->getFixValue();
        $valueDistanceKilo = $request->getValueDistanceKilo();

        $carrier->setName($name);
        $carrier->setFixValue($fixValue);
        $carrier->setValueDistanceKilo($valueDistanceKilo);

        return $this->repository->persist($carrier);
    }
}
