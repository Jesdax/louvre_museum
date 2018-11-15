<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:28
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class NotSundayValidator
 * @package AppBundle\Validator\Constraints
 */
class NotSundayValidator extends ConstraintValidator
{

    const SUNDAY = "7";

    public function validate($dateOfVisit, Constraint $constraint)
    {
        if ($dateOfVisit->format('N') === self::SUNDAY) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }
    }

}