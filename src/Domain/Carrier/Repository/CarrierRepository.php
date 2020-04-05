<?php

namespace App\Domain\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Shared\Vo\Id;

interface CarrierRepository
{
    public function findAll(): ?array;
    public function findById(Id $id): ?Carrier;
    public function persist(Carrier $carrier): Carrier;
}
