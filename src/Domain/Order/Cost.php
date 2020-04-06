<?php

namespace App\Domain\Order;

class Cost
{
    private string $product;
    private string $carrier;
    private ?float $cost;

    /**
     * Cost constructor.
     * @param string $product
     * @param string $carrier
     * @param float $cost
     */
    public function __construct(string $product, string $carrier, ?float $cost)
    {
        $this->product = $product;
        $this->carrier = $carrier;
        $this->cost = $cost;
    }

    /**
     * @return string
     */
    public function getProduct(): string
    {
        return $this->product;
    }

    /**
     * @param string $product
     * @return Cost
     */
    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarrier(): string
    {
        return $this->carrier;
    }

    /**
     * @param string $carrier
     * @return Cost
     */
    public function setCarrier(string $carrier): self
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @param float $cost
     * @return Cost
     */
    public function setCost(float $cost): self
    {
        $this->cost = $cost;
        return $this;
    }
}
