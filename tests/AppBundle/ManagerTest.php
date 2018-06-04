<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 04/06/18
 * Time: 13:09
 */

namespace Tests\AppBundle;


use AppBundle\Entity\Booking;
use AppBundle\Manager\BookingManager;
use PHPUnit\Framework\TestCase;

class ManagerTest extends TestCase
{

    /**
     * @param $nbTickets
     * @param $expectedNb
     * @dataProvider dataTickets
     */
    public function testBookingComplete($nbTickets, $expectedNb)
    {
        $booking = new Booking();
        $booking->setNbTickets($nbTickets);

        $manager = $this->getMockBuilder(BookingManager::class)
            ->disableOriginalConstructor()
            ->setMethodsExcept(['bookingComplete'])
            ->getMock();

        $manager->bookingcomplete($booking);
        $this->assertSame($expectedNb, $booking->getTickets()->count());
    }

    public function dataTickets()
    {
        return array(
            [1, 1],
            [4, 4],
            [8, 8]
        );
    }

}