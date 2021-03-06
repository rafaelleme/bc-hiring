<?php

namespace App\Domain\Shared\Vo;

use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Doctrine\ORM\Mapping as ORM;

/**
 * @property string value
 * @ORM\Embeddable()
 */
class Id
{
    /**
     * @ORM\Column(type="string", name="id")
     */
    private $value;

    public function __construct(?string $value = null)
    {
        if (empty($value)) {
            try {
                $value = Uuid::uuid4();
                $this->value = $value;
            } catch (Exception $e) {
                throw new InvalidArgumentException('An error occurred while generating the UUID.', 0, $e);
            }
        }

        if (!Uuid::isValid($value)) {
            new InvalidArgumentException('This is an invalid UUID', 0);
        }

        $this->value = Uuid::fromString($value);
    }

    public function validate(): bool
    {
        return true;
    }

    public function getValue(): string
    {
        return $this->value->toString();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
