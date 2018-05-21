<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 16/05/18
 * Time: 11:11
 */

namespace AppBundle\Service;


use AppBundle\Entity\Booking;

class MailService
{

    private $email;
    private $twig;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig_Environment)
    {
        $this->email = $mailer;
        $this->twig = $twig_Environment;
    }

    public function sendMail(Booking $booking)
    {

        $message = (new \Swift_Message())
            ->setFrom('augustin.kavera@gmail.com')
            ->setSubject('Votre e-billet pour l\'entrée du musée du Louvre')
            ->setTo($booking->getEmail());

        $logo = $message->embed(\Swift_Image::fromPath('public/images/logo-louvre.jpg'));

        $message->setBody(
            $this->twig->render('booking/email.html.twig', ['booking' => $booking, 'tickets' => $booking->getTickets(), 'logo' => $logo]), 'text/html', 'UTF-8');

        $this->email->send($message);
    }

}