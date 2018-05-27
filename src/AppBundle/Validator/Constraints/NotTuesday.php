<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:32
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class NotTuesday
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class NotTuesday extends Constraint
{
    public $message = 'La réservation n\'est pas disponible le mardi';

}