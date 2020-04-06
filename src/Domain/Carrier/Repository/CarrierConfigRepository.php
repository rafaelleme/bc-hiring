<?php

namespace App\Domain\Carrier\Repository;

use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\CarrierConfig;

interface CarrierConfigRepository
{
    public function findByCarrier(Carrier $carrier, float $weight): ?object;
}
