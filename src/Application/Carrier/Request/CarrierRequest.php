<?php

namespace App\Application\Carrier\Request;

use App\Application\Shared\Request\JsonRequest;

/**
 * @property string name
 * @property array configs
 */
class CarrierRequest
{
    use JsonRequest;

    private $name;
    private $configs;

    public function getName(): string
    {
        return $this->name;
    }

    public function getConfigs(): array
    {
        return $this->configs;
    }

}
