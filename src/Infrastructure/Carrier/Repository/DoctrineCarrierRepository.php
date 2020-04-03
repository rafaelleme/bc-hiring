<?php

namespace App\Infrastructure\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\Repository\CarrierRepository;
use App\Infrastructure\Shared\Repository\DoctrineRepository;

class DoctrineCarrierRepository extends DoctrineRepository
{
    protected $entity = Carrier::class;
}
