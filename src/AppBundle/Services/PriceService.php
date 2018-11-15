<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 14/05/18
 * Time: 12:38
 */

namespace AppBundle\Services;

use AppBundle\Services\AgeService;

class PriceService
{

    const BABY = 0;
    const CHILD = 8;
    const NORMAL = 16;
    const SENIOR = 12;
    const REDUCE = 10;

    public function priceTicket($reducedPrice, $age, $type)
    {
        $price = 0;

        if (!is_bool($reducedPrice) | !is_int($age) | !is_bool($type))
            throw new \InvalidArgumentException('Les arguments sont erronés !');

        //var_dump($reducedPrice, $age);

        if($reducedPrice && $age >= 12) {
            $price = self::REDUCE;
        } else {
            if ($age < 4)
                $price = self::BABY;
            elseif ($age >= 4 && $age < 12)
                $price = self::CHILD;
            elseif ($age >= 60)
                $price = self::SENIOR;
            else
                $price = self::NORMAL;
        }

        // Price for half-day
        if ($type === false) {
        $price = $price/2;
        }

        // var_dump($price); exit;

        return $price;
    }

}