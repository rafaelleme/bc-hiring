<?php

namespace App\Application\Carrier\Request;

use App\Application\Shared\Request\JsonRequest;

/**
 * @property string name
 * @property float fixValue
 * @property float valueDistanceKilo
 */
class CarrierRequest
{
    use JsonRequest;

    private $name;
    private $fixValue;
    private $valueDistanceKilo;

    public function getName(): string
    {
        return $this->name;
    }

    public function getFixValue(): float
    {
        return $this->fixValue;
    }

    public function getValueDistanceKilo(): float
    {
        return $this->valueDistanceKilo;
    }
}
