<?php

namespace App\Domain\Product;

use App\Domain\Shared\Entity\DomainEntity;
use App\Domain\Shared\Entity\EntitySerializer;
use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="products")
 * @property string name
 * @property float weight
 */
class Product extends DomainEntity implements \JsonSerializable
{
    use EntitySerializer;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    /**
     * @ORM\Column(type="float")
     */
    private float $weight;

    public function __construct(
        string $name,
        float $weight
    )
    {
        parent::__construct(new Id());
        $this->name = $name;
        $this->weight = $weight;

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

    protected function serialize(): array
    {
        return [
            'id',
            'name',
            'weight'
        ];
    }

    public function calculateWeightDistance(): float
    {
        return $this->weight * 1; #distance
    }
}
