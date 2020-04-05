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
            $field = 'get' . ucfirst($field);
            if (in_array($field, $classMethods)) {
                $objectHasValue = $this->checkIfObjectHasValueMethod($this->{$field}());
                $underscoreField = $this->camelCaseToUnderscore($field);

                if ($this->{$field}() instanceof ArrayCollection) {
                    $res[$underscoreField] = $this->{$field}()->toArray();
                    continue;
                }

                $res[$underscoreField] = $objectHasValue ? $this->{$field}()->value() : $this->{$field}();
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

    public function camelCaseToUnderscore($input)
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', str_replace('get','',$input)));
    }
}
