<?php

namespace App\Tests\Domain\Order;
use App\Domain\Carrier\Carrier;
use App\Domain\Carrier\CarrierConfig;
use App\Domain\Order\Order;
use App\Domain\Product\Product;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOrderCalculationCost()
    {
        $carrierConfig = new CarrierConfig(0, 1000, 10.50, 0.50);

        $carrier = new Carrier('Custom carrier');

        $carrier->setConfig($carrierConfig);

        $product = new Product('Custom product',1.05);

        $customOrder1 = new Order(345.00, $carrier, $product);
        $customOrder2 = new Order(1.38, $carrier, $product);
        $customOrder3 = new Order(1440.31, $carrier, $product);
        $customOrder4 = new Order(74.82, $carrier, $product);

        $this->assertEquals(191.625, $customOrder1->calculateCost());
        $this->assertEquals(11.2245, $customOrder2->calculateCost());
        $this->assertEquals(766.66275, $customOrder3->calculateCost());
        $this->assertEquals(49.7805, $customOrder4->calculateCost());
    }
}
