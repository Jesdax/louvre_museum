<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 03/06/18
 * Time: 21:27
 */

namespace Tests\AppBundle;


use AppBundle\Services\AgeService;
use PHPUnit\Framework\TestCase;

class AgeTest extends TestCase
{

    /**
     * @param $dateOfVisit
     * @param $dateOfBirth
     * @param $expectedAge
     * @dataProvider dataAge
     */
    public function testAge($dateOfVisit, $dateOfBirth, $expectedAge)
    {
        $age = new AgeService();
        $this->assertEquals($expectedAge, $age->callAge($dateOfVisit, $dateOfBirth));
    }

    public function dataAge()
    {
        return array(
            [new \DateTime('2018-06-03'), new \DateTime('1991-03-08'), 27],
            [new \DateTime('2018-06-03'), new \DateTime('1990-11-14'), 27],
            [new \DateTime('2018-06-03'), new \DateTime('2017-07-30'), 0],
            [new \DateTime('2018-06-03'), new \DateTime('1956-03-08'), 62],
            [new \DateTime('2018-06-03'), new \DateTime('2010-03-08'), 8]
        );
    }

}