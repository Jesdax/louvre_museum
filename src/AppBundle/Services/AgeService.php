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
    public function callAge(\DateTime $dateOfVisit, \DateTime $dateOfBirth)
    {

        return date_diff($dateOfVisit,$dateOfBirth)->y;
    }

}