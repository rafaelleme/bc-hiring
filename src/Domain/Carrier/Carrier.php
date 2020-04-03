<?php

namespace App\Domain\Carrier;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Infrastructure\Carrier\Repository\DoctrineCarrierRepository")
 */
class Carrier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Embedded(class="", columnPrefix=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     */
    private $fix_value;

    /**
     * @ORM\Column(type="float")
     */
    private $value_distance_kilo;

    public function getId(): ?int
    {
        return $this->id;
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
        return $this->fix_value;
    }

    public function setFixValue(float $fix_value): self
    {
        $this->fix_value = $fix_value;

        return $this;
    }

    public function getValueDistanceKilo(): ?float
    {
        return $this->value_distance_kilo;
    }

    public function setValueDistanceKilo(float $value_distance_kilo): self
    {
        $this->value_distance_kilo = $value_distance_kilo;

        return $this;
    }
}
