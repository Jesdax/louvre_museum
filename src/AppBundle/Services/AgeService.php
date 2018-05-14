<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 14/05/18
 * Time: 12:34
 */

namespace AppBundle\Services;

use AppBundle\Entity\Booking;
use AppBundle\Entity\Ticket;

class AgeService
{
    public function calculAge($dateOfVisit, $dateOfBirth)
    {
        $age = date_diff($dateOfVisit, $dateOfBirth);
        $age = get_object_vars($age);
        $age = $age['y'];

        return $age;
    }

}