<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 09/05/18
 * Time: 17:05
 */

namespace AppBundle\Manager;


use AppBundle\Entity\Booking;
use AppBundle\Entity\Ticket;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BookingManager
{

    private $session;


    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }


    public function setBookingSession(Booking $booking)
    {
        $this->session->set('booking', $booking);
    }

    public function getBookingSession()
    {
        $booking = $this->session->get('booking');
        return $booking;
    }

    public function bookingInitialisation(Booking $booking)
    {
        while (count($booking->getTickets()) !== $booking->getNbTickets()) {
            if (count($booking->getTickets()) > $booking->getNbTickets()) {
                $booking->removeTicket($booking->getTickets()->last());
            } else {
                $booking->addTicket(new Ticket());
            }
        }
    }

}