<?php

namespace App\Application\Carrier\Service;

use App\Application\Carrier\Request\CarrierRequest;
use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\CarrierConfig;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;

/**
 * @property DoctrineCarrierRepository repository
 */
class CreateCarrierService
{
    private DoctrineCarrierRepository $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CarrierRequest $request): ?Carrier
    {
        $name = $request->getName();
        $configs = $request->getConfigs();

        $carrier = new Carrier($name);

        foreach ($configs as $config) {
            $carrierConfig = new CarrierConfig(
                $config->minWeight,
                $config->maxWeight,
                $config->fixValue,
                $config->valueDistanceKilo,
            );
            $carrierConfig->setCarrier($carrier);

            $carrier->addConfig($carrierConfig);
        }

        $carrier = $this->repository->persist($carrier);

        return $carrier;
    }
}
