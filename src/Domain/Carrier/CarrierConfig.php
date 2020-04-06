<?php

namespace App\Domain\Carrier;

use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Entity\EntitySerializer;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @property Carrier carrier
 * @property float minWeight
 * @property float maxWeight
 */
class CarrierConfig extends DomainEntity
{
    use EntitySerializer;

    /**
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="configs")
     * @ORM\JoinColumn(name="carrier_id", referencedColumnName="id")
     */
    protected Carrier $carrier;

    /**
     * @ORM\Column(type="float", options={"default": 0})
     */
    private float $minWeight;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private ?float $maxWeight;

    public function getCarrier(): Carrier
    {
        return $this->carrier;
    }

    public function setCarrier(Carrier $carrier): self
    {
        $this->carrier = $carrier;
        return $this;
    }

    public function getMinWeight(): float
    {
        return $this->minWeight;
    }

    public function setMinWeight(float $minWeight): self
    {
        $this->minWeight = $minWeight;
        return $this;
    }

    public function getMaxWeight(): ?float
    {
        return $this->maxWeight;
    }

    public function setMaxWeight(?float $maxWeight = null): self
    {
        $this->maxWeight = $maxWeight;
        return $this;
    }

    protected function serialize(): array
    {
        return [
            'id',
            'minWeight',
            'maxWeight'
        ];
    }
}
