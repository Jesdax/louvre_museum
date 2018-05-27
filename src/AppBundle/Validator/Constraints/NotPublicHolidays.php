<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 12:57
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class NotPublicHolidays
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class NotPublicHolidays extends Constraint
{
    public $message = 'La réservation n\'est pas disponible les jours fériés';

}