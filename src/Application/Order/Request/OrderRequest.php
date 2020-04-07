<?php

namespace App\Application\Order\Request;

use App\Application\Shared\Request\JsonRequest;

class OrderRequest
{
    use JsonRequest;

    private $distance;
    private $carrier;
    private $product;

    public function getDistance(): float
    {
        return $this->distance;
    }

    public function getCarrier(): string
    {
        return $this->carrier;
    }

    public function getProduct(): string
    {
        return $this->product;
    }
}
