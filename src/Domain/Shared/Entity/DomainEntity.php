<?php

namespace App\Domain\Shared\Entity;

use App\Domain\Shared\Vo\Id;
use Doctrine\ORM\Mapping as ORM;

/**
 * @property Id id
 */
abstract class DomainEntity implements \JsonSerializable
{
    /**
     * @var Id
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="NONE")
     */
    protected $id;

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }
}
