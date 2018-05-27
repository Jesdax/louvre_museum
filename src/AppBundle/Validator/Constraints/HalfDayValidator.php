<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 12:52
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HalfDayValidator extends ConstraintValidator
{
    public function validate($booking, Constraint $constraint)
    {
        if ($booking->getDateOfVisit()->format('Y-m-d') === date('Y-m-d') && date('H') >= 14) {
            $booking->setType(false);
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }
}