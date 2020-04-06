<?php

namespace App\Tests\Domain\Carrier;

use App\Domain\Carrier\Carrier;
use App\Domain\Product\Product;
use PHPUnit\Framework\TestCase;

class CostTest extends TestCase
{
    public function testCarrierCostCalculation()
    {
        $boxDex = new Carrier(
            'BoxDex',
            10,
            0.05
        );

        $this->assertEquals(13.25, $boxDex->calculateCost(new Product(
            'Fone de ouvido gamer',
            1,
            65
        )));

        $this->assertEquals(15.025, $boxDex->calculateCost(new Product(
            'Custom Product 1',
            0.1,
            1005
        )));

        $this->assertEquals(10.25, $boxDex->calculateCost(new Product(
            'Custom Product 2',
            10,
            0.5
        )));
    }
}
