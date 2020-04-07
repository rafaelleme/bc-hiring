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
    private DoctrineCarrierRepository $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id, CarrierRequest $request): ?Carrier
    {
        /** @var Carrier $carrier */
        $carrier = $this->repository->findById(new Id($id));

        $name = $request->getName();

        $carrier->setName($name);

        return $this->repository->persist($carrier);
    }
}
