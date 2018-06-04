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

    public $message = 'validator.half_day';


    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}