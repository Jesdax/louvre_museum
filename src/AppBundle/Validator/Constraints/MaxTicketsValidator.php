<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:17
 */

namespace AppBundle\Validator\Constraints;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class MaxTicketsValidator extends ConstraintValidator
{

    const MAX_TICKET_PER_DAY = 10;

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }


    public function validate($booking, Constraint $constraint)
    {
        $ticketsPerDay = $this->em->getRepository('AppBundle:Booking')->getNbTicketPerDay($booking->getDateOfVisit());

        $ticketsLeft = self::MAX_TICKET_PER_DAY - $ticketsPerDay;

        if ($booking->getNbTickets() >= $ticketsLeft) {
            $this->context->buildViolation($constraint->message)->atPath('nbTickets')->setParameter('Billets restant', ($ticketsLeft > 0) ? $ticketsLeft: 0)->addViolation();
        }
    }

}