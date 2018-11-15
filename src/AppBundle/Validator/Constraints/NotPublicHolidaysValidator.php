<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 22/05/18
 * Time: 13:06
 */

namespace AppBundle\Validator\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NotPublicHolidaysValidator extends ConstraintValidator
{
    public function validate($dateOfVisit, Constraint $constraint)
    {
        if (!$dateOfVisit instanceof \DateTime) {
            $dateOfVisit = new \DateTime($dateOfVisit);
        }

        $year = (int) $dateOfVisit->format('Y');

        if (!$year) {
            $year = intval(date('Y'));
        }

        $easterDate = easter_date($year);
        $easterDay = date('j', $easterDate);
        $easterMonth = date('n', $easterDate);
        $easterYear = date('Y', $easterDate);

        $publicHolidays = [
            mktime(0,0,0,1,1, $year), // 1er janvier
            mktime(0,0,0,5,1,$year), // Fête du Travail
            mktime(0,0,0,5,8,$year), // Victoire des alliés
            mktime(0,0,0,7,14,$year), // Fête nationale
            mktime(0,0,0,8,15,$year), // Assomption
            mktime(0,0,0,11,1,$year), // Toussaint
            mktime(0,0,0,11,11,$year), // Armistice
            mktime(0,0,0,12,25,$year), // Noel
            mktime(0,0,0, $easterMonth, $easterDay + 1, $year), // lundi de paque
            mktime(0,0,0, $easterMonth, $easterDay + 39, $year), // jeudi de l'ascension
            mktime(0,0,0, $easterMonth, $easterDay + 50, $year), // lundi de pentecôte

        ];

        if (in_array($dateOfVisit->getTimestamp(), $publicHolidays,true)) {
            $this->context->buildViolation($constraint->message)->addViolation();
        }

    }

}