<?php

namespace App\Application\Carrier\Service;

use App\Domain\Carrier\Carrier;
use App\Domain\Shared\Vo\Id;
use App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository;

/**
 * @property DoctrineCarrierRepository repository
 */
class RemoveCarrierService
{
    private $repository;

    public function __construct(DoctrineCarrierRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(Id $id): void
    {
        /** @var Carrier $carrier */
        $carrier = $this->repository->findById($id);

        $this->repository->remove($carrier);
    }
}
