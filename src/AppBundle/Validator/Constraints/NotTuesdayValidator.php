<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:32
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class NotTuesdayValidator
 * @package AppBundle\Validator\Constraints
 */
class NotTuesdayValidator extends ConstraintValidator
{
    const TUESDAY = "2";

    public function validate($dateOfVisit, Constraint $constraint)
    {
        if ($dateOfVisit->format('N') === self::TUESDAY) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }

    }
}