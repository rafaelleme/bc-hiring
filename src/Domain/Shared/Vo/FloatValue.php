<?php

namespace App\Domain\Shared\Vo;

/**
 * @property float value
 */
abstract class FloatValue
{
    protected $value;

    public function __construct(float $value)
    {
        $this->value = $value;
        $this->validate();
    }

    public abstract function validate(): bool;
}
