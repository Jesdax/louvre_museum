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

        if (!is_bool($reducedPrice) | !is_int($age) | !is_bool($type)) {
            throw new \InvalidArgumentException('Les arguments son erronés !');
        }

        if (!$reducedPrice) {
            switch ($age) {
                case ($age >= 12 && $age < 60):
                    $price = self::NORMAL;
                    break;
                case ($age >= 60):
                    $price = self::SENIOR;
                    break;
                case ($age >= 4 && $age < 12):
                    $price = self::CHILD;
                    break;
                case ($age < 4):
                    $price = self::BABY;
                    break;
            }
        } else {
            $price = self::NORMAL - self::REDUCE;
        }
        // Price for half-day
        if ($type === false) {
        $price = $price/2;
        }

        return $price;
    }

}