<?php

namespace App\Domain\Product;

use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Entity\EntitySerializer;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @property string name
 * @property float weight
 * @property float distance
 */
class Product extends DomainEntity implements \JsonSerializable
{
    use EntitySerializer;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $distance;

    public function __construct(
        string $name,
        float $weight,
        float $distance
    )
    {
        parent::__construct(new Id());
        $this->name = $name;
        $this->weight = $weight;
        $this->distance = $distance;

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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->distance;
    }

    public function setDistance(float $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    protected function serialize(): array
    {
        return [
            'id',
            'name',
            'weight',
            'distance'
        ];
    }

    public function calculateWeightDistance(): float
    {
        return $this->weight * $this->distance;
    }
}
