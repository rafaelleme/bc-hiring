<?php

namespace App\Domain\Carrier\Repository;

interface CarrierRepository
{
    public function findAll(): ?array;
    public function findById(): ?object;
}
