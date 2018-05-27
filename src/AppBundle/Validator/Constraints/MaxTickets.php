<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:26
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class MaxTickets
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class MaxTickets extends Constraint
{
    public $message = 'Il n\'est plus possible de réserver, le quota a été atteint.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

}