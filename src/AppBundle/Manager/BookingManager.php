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
use AppBundle\Services\MailService;
use AppBundle\Services\PriceService;
use AppBundle\Services\StripeInit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Services\AgeService;

class BookingManager
{

    private $session;
    private $ageService;
    private $priceService;
    private $stripeInit;
    private $entityManager;
    private $email;


    public function __construct(SessionInterface $session, AgeService $ageService, PriceService $priceService, StripeInit $stripeInit, EntityManagerInterface $entityManager, MailService $mailService)
    {
        $this->session = $session;
        $this->ageService = $ageService;
        $this->priceService = $priceService;
        $this->stripeInit = $stripeInit;
        $this->entityManager = $entityManager;
        $this->email = $mailService;

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

    public function bookingComplete(Booking $booking)
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
            $age = $this->ageService->callAge($booking->getDateOfVisit(),$ticket->getDateOfBirth());
            $ticket->setAge($age);

            $price = $this->priceService->priceTicket($ticket->getReducedPrice(), $ticket->getAge(), $booking->getType());
            $ticket->setPrice($price);

            $totalPrice += $ticket->getPrice();

        }
        $booking->setTotalPrice($totalPrice);

        return $booking;
    }

    public function payStep(Request $request, Booking $booking)
    {
        $transaction = $this->stripeInit->payment($booking, $request->request->get('stripeToken'));

        if ($transaction !== false) {
            $this->entityManager->persist($booking);
            $this->entityManager->flush();

            $this->email->sendMail();

        }

        return $transaction;
    }

    public function clearSession()
    {
        $this->session->clear();
    }



}