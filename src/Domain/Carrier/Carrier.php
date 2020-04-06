<?php

namespace App\Domain\Carrier;

use App\Domain\Product\Product;
use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Vo\Id;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="carriers")
 * @property string name
 * @property CarrierConfig config
 * @property ArrayCollection configs
 */
class Carrier extends DomainEntity implements \JsonSerializable
{
    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="CarrierConfig", mappedBy="carrier", cascade={"persist"})
     */
    protected Collection $configs;

    public function __construct(string $name)
    {
        parent::__construct(new Id());
        $this->name = $name;
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

    public function setConfig(CarrierConfig $carrierConfig): self
    {
        $this->config = $carrierConfig;
        return $this;
    }

    public function getConfig(): CarrierConfig
    {
        return $this->config;
    }

    public function getConfigs()
    {
        return $this->configs;
    }

    public function addConfig(CarrierConfig $config): self
    {
        $this->configs->add($config);
        return $this;
    }

    public function calculateCost(Product $product): float
    {
        return 1; #$this->fixValue + $this->calculateValueDistanceKilo($product->calculateWeightDistance());
    }

    private function calculateValueDistanceKilo(float $weightDistance): float
    {
        return 1; #$this->valueDistanceKilo * $weightDistance;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'configs' => $this->getConfigs()->toArray()
        ];
    }
}
