<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 03/06/18
 * Time: 21:39
 */

namespace Tests\AppBundle;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PagesTest extends WebTestCase
{

    /**
     * @param $method
     * @param $route
     * @param $expectedResult
     * @dataProvider findMethod
     */
    public function testUp($method, $route, $expectedResult)
    {
        $client = static::createClient();
        $client->request($method, $route);

        $this->assertSame($expectedResult, $client->getResponse()->getStatusCode());
    }

    public function findMethod()
    {
        return array(
            ['GET', '/fr/', 200],
            ['GET', '/ticket', 404],
            ['GET', '/summary', 404],
            ['GET', '/final_summary/test123', 404],
            ['GET', '/', 302]
        );
    }

}