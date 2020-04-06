<?php

namespace App\Domain\Shared;

use Doctrine\Common\Collections\ArrayCollection;

trait OrderCollection
{
    public function orderByAsc(ArrayCollection $collection, string $field): ArrayCollection
    {
        $iterator = $collection->getIterator();

        $iterator->uasort(function ($first, $second) use ($field) {
            return $first->{$field}() > $second->{$field}();
        });

        return new ArrayCollection(array_values(iterator_to_array($iterator)));
    }
}
