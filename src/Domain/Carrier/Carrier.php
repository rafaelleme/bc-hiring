<?php

namespace App\Domain\Carrier;

use App\Domain\Product\Product;
use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Entity\EntitySerializer;
use App\Domain\Shared\Vo\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @property string name
 * @property float fixValue
 * @property float valueDistanceKilo
 * @property ArrayCollection configs
 */
class Carrier extends DomainEntity implements \JsonSerializable
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\Column(type="float",name="fix_value")
     */
    private float $fixValue;

    /**
     * @ORM\Column(type="float",name="value_distance_kilo")
     */
    private float $valueDistanceKilo;

    /**
     * @ORM\OneToMany(targetEntity="CarrierConfig", mappedBy="carrier")
     */
    protected Collection $configs;

    public function __construct(
        string $name,
        float $fixValue,
        float $valueDistanceKilo
    )
    {
        parent::__construct(new Id());
        $this->name = $name;
        $this->fixValue = $fixValue;
        $this->valueDistanceKilo = $valueDistanceKilo;
        $this->configs = new ArrayCollection();
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getConfigs(): Collection
    {
        return $this->configs;
    }

    public function setConfigs(ArrayCollection $configs): self
    {
        $this->configs = $configs;
        return $this;
    }

    public function calculateCost(Product $product): float
    {
        return $this->fixValue + $this->calculateValueDistanceKilo($product->calculateWeightDistance());
    }

    private function calculateValueDistanceKilo(float $weightDistance): float
    {
        return $this->valueDistanceKilo * $weightDistance;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'fixValue' => $this->getFixValue(),
            'valueDistanceKilo' => $this->getValueDistanceKilo(),
            'configs' => $this->getConfigs()->toArray()
        ];
    }
}
