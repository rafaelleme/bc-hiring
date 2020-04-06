<?php

namespace App\Domain\Order;

use App\Domain\Carrier\Carrier;
use App\Domain\Product\Product;
use App\Domain\Shared\Entity\DomainEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="orders")
 * @property float distance
 * @property Carrier carrier
 * @property Product product
 */
class Order extends DomainEntity implements \JsonSerializable
{
    /**
     * @ORM\Column(type="float",name="distance")
     */
    private float $distance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Carrier\Carrier")
     * @ORM\JoinColumn(name="carrier_id", referencedColumnName="id")
     */
    protected Carrier $carrier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Domain\Product\Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected Product $product;

    /**
     * @return float
     */
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     * @return Order
     */
    public function setDistance(float $distance): self
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return Carrier
     */
    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    /**
     * @param Carrier $carrier
     * @return Order
     */
    public function setCarrier(Carrier $carrier): self
    {
        $this->carrier = $carrier;
        return $this;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     * @return Order
     */
    public function setProduct(Product $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function calculateCost(): float
    {
        $fixValue = $this->carrier->getConfig()->getFixValue();

        $partialCost = $this->calculateParcialCost();

        return $fixValue + $partialCost;
    }

    private function calculateParcialCost(): float
    {
        $weight = $this->product->getWeight();
        $distance = $this->distance;
        $value = $this->carrier->getConfig()->getValueDistanceKilo();

        return $weight * $distance * $value;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'distance' => $this->getDistance(),
            'product' => $this->getProduct(),
            'carrier' => $this->getCarrier()
        ];
    }
}
