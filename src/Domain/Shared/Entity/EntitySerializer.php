<?php

namespace App\Domain\Shared\Entity;

use Doctrine\Common\Collections\ArrayCollection;

trait EntitySerializer
{
    protected abstract function serialize(): array;

    public function jsonSerialize()
    {
        $serializableFields = $this->serialize();

        $classMethods = get_class_methods($this);

        $res = [];

        foreach ($serializableFields as $field) {
            $methodField = self::toMethod($field);

            if (in_array($methodField, $classMethods)) {
                $objectHasValue = $this->checkIfObjectHasValueMethod($this->{$methodField}());
                $underscoreField = $this->camelCaseToUnderscore($methodField);

                if ($this->{$methodField}() instanceof ArrayCollection) {
                    $res[$underscoreField] = $this->{$methodField}()->toArray();
                    continue;
                }

                $res[$underscoreField] = $objectHasValue ? $this->{$methodField}()->value() : $this->{$methodField}();
            }
        }

        return $res;
    }

    public function checkIfObjectHasValueMethod($object): bool
    {
        $methods = get_class_methods($object);

        if ($methods && in_array('value', $methods)) {
            return true;
        }

        return false;
    }

    public function camelCaseToUnderscore($input): ?string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', str_replace('get','',$input)));
    }

    public static function toMethod(string $field): ?string
    {
        return 'get' . ucfirst($field);
    }
}
