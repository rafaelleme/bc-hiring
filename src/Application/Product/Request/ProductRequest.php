<?php

namespace App\Application\Product\Request;

use App\Application\Shared\Request\JsonRequest;

/**
 * Class ProductRequest
 * @package App\Application\Shared\Service\Request
 * @property string name
 * @property float weight
 * @property float distance
 */
class ProductRequest
{
    use JsonRequest;

    private $name;
    private $weight;

    public function getName(): string
    {
        return $this->name;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }
}
