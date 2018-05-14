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
use AppBundle\Services\PriceService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Services\AgeService;

class BookingManager
{

    private $session;
    private $ageService;
    private $priceService;


    public function __construct(SessionInterface $session, AgeService $ageService, PriceService $priceService)
    {
        $this->session = $session;
        $this->ageService = $ageService;
        $this->priceService = $priceService;

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

    public function getPriceOfTicket(Booking $booking)
    {
        $tickets = $booking->getTickets();
        $totalPrice = 0;

        foreach ($tickets as $ticket) {
            $age = $this->ageService->calculAge($booking->getDateOfVisit(),$ticket->getDateOfBirth());
            $ticket->setAge($age);

            $price = $this->priceService->priceTicket($ticket->getReducedPrice(), $ticket->getAge(), $booking->getType());
            $ticket->setPrice($price);

            $totalPrice += $ticket->getPrice();

        }
        $booking->setTotalPrice($totalPrice);

        return $booking;
    }

}