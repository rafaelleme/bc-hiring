<?php

namespace App\Domain\Shared\Entity;

abstract class DomainEntity implements \JsonSerializable
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="dbid", name="id")
     *
     * @var DbId
     */
    protected $id;

}
