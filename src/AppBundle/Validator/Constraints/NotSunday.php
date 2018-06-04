<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 15:29
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;

/**
 * Class NotSunday
 * @package AppBundle\Validator\Constraints
 * @Annotation
 */
class NotSunday extends Constraint
{
    public $message = 'validator.not_sunday';

}