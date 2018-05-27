<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 12:50
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class HalfDay
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class HalfDay extends Constraint
{

    public $message = 'Il est 14h00 passés, seuls les billets à la demi-journée sont disponibles.';


    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}