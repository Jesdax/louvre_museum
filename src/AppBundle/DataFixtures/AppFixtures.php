<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 16/05/18
 * Time: 10:55
 */

namespace AppBundle\DataFixtures;



use AppBundle\Entity\Booking;
use AppBundle\Entity\Ticket;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $timestamp = rand(strtotime('1970-01-01'), strtotime('2018-03-30'));
        $randomDate = date("d.m.Y", $timestamp);
        $numberTicket = 10;
        //create 10 booking tickets

        $booking = new Booking();
        $booking->setCreateAt(new \DateTime('NOW'));
        $booking->setDateOfVisit(new \DateTime('2018-06-06'));
        $booking->setNbTickets($numberTicket);
        $booking->setEmail('test@mail.fr');
        $booking->setTotalPrice(16);
        $booking->setType(Booking::DAY);

        for ($i = 0; $i < $numberTicket; $i++) {
            $ticket = new Ticket();
            $ticket->setLastname('Kavera'.$i);
            $ticket->setFirstname('August'.$i);
            $ticket->setCountry('France');
            $ticket->setDateOfBirth(new \DateTime($randomDate));
            $ticket->setPrice(16);
            $ticket->setReducedPrice(false);
            $ticket->setAge(16);


            $booking->addTicket($ticket);

            $manager->persist($ticket);
            $manager->persist($booking);
        }
        $manager->flush();
    }


}