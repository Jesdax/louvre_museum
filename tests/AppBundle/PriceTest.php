<?php


namespace Tests\AppBundle;


use AppBundle\Services\PriceService;
use PHPUnit\Framework\TestCase;

class PriceTest extends TestCase
{

    const DAY = true;
    const HALF_DAY = false;
    const DISCOUNT = true;
    const NOT_DISCOUNT = false;

    private $price;


    /**
     * @param $reducedPrice
     * @param $age
     * @param $type
     * @param $expectedPrice
     * @dataProvider dataPrice
     */
    public function testPrice($type, $age, $reducedPrice, $expectedPrice)
    {
        $price = new PriceService();
        $this->assertSame($expectedPrice, $price->priceTicket($reducedPrice, $age, $type));
    }

    public function dataPrice()
    {
        return array(
            [PriceTest::DAY, 27, PriceTest::DISCOUNT, 6],
            [PriceTest::HALF_DAY, 27, PriceTest::NOT_DISCOUNT, 8],
            [PriceTest::DAY, 4, PriceTest::NOT_DISCOUNT, 8],
            [PriceTest::HALF_DAY, 4, PriceTest::DISCOUNT, 4],
            [PriceTest::DAY, 2, PriceTest::DISCOUNT, 0],
            [PriceTest::HALF_DAY, 2, PriceTest::DISCOUNT, 0],
            [PriceTest::DAY, 62, PriceTest::NOT_DISCOUNT, 12],
            [PriceTest::HALF_DAY, 62, PriceTest::NOT_DISCOUNT, 6]
        );
    }

}