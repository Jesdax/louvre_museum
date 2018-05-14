<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Booking;
use AppBundle\Form\BookingType;
use AppBundle\Form\TicketsType;
use AppBundle\Manager\BookingManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;


class BookingController extends Controller
{

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/", name="accueil")
     */
    public function indexAction(Request $request, BookingManager $bookingManager)
    {

        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingManager->setBookingSession($booking);
            return $this->redirectToRoute('ticket');
        }
        return $this->render('booking/index.html.twig', ['form' => $form->createView()]);


    }


    /**
     * @param Request $request
     * @param BookingManager $bookingManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route("/ticket", name="ticket")
     */
    public function ticketAction(Request $request, BookingManager $bookingManager)
    {
        $booking = $request->getSession()->get('booking');
        $bookingManager->bookingInitialisation($booking);

        $formTicket = $this->createForm(TicketsType::class, $booking);
        $formTicket->handleRequest($request);

        if ($formTicket->isSubmitted() && $formTicket->isValid()) {
            $bookingManager->setBookingSession($booking);
            return $this->redirectToRoute('summary');
        }
        return $this->render('booking/ticket.html.twig', ['form' => $formTicket->createView()]);
    }

}