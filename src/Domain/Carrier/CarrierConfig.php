<?php

namespace App\Domain\Carrier;

use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Entity\EntitySerializer;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="carrier_configs")
 * @property Carrier carrier
 * @property float minWeight
 * @property float maxWeight
 * @property float fixValue
 * @property float valueDistanceKilo
 */
class CarrierConfig extends DomainEntity
{
    use EntitySerializer;

    /**
     * @ORM\ManyToOne(targetEntity="Carrier", inversedBy="configs", cascade={"persist"})
     * @ORM\JoinColumn(name="carrier_id", referencedColumnName="id")
     */
    protected Carrier $carrier;

    /**
     * @ORM\Column(type="float", options={"default": 0})
     */
    private float $minWeight;

    /**
     * @ORM\Column(type="float", options={"default": 10000})
     */
    private float $maxWeight;

    /**
     * @ORM\Column(type="float",name="fix_value")
     */
    private float $fixValue;

    /**
     * @ORM\Column(type="float",name="value_distance_kilo")
     */
    private float $valueDistanceKilo;

    public function __construct(
        float $minWeight,
        float $maxWeight,
        float $fixValue,
        float $valueDistanceKilo
    )
    {
        parent::__construct(new Id());
        $this->minWeight = $minWeight;
        $this->maxWeight = $maxWeight;
        $this->fixValue = $fixValue;
        $this->valueDistanceKilo = $valueDistanceKilo;
    }

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

    public function getMaxWeight(): float
    {
        return $this->maxWeight;
    }

    public function setMaxWeight(float $maxWeight): self
    {
        $this->maxWeight = $maxWeight;
        return $this;
    }

    public function getFixValue(): ?float
    {
        return $this->fixValue;
    }

    public function setFixValue(float $fixValue): self
    {
        $this->fixValue = $fixValue;

        return $this;
    }

    public function getValueDistanceKilo(): ?float
    {
        return $this->valueDistanceKilo;
    }

    public function setValueDistanceKilo(float $valueDistanceKilo): self
    {
        $this->valueDistanceKilo = $valueDistanceKilo;

        return $this;
    }

    protected function serialize(): array
    {
        return [
            'id',
            'minWeight',
            'maxWeight',
            'fixValue',
            'valueDistanceKilo'
        ];
    }
}
