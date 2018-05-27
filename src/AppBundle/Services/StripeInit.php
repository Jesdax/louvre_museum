<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 14/05/18
 * Time: 15:07
 */

namespace AppBundle\Services;


use AppBundle\Entity\Booking;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;

class StripeInit
{

    private $secretKey;

    public function __construct($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function payment(Booking $booking, $token)
    {
        Stripe::setApiKey($this->secretKey);

        try {
            $charge = Charge::create([
                'amount' => $booking->getTotalPrice() * 100,
                'currency' => 'eur',
                'description' => 'Billetterie du Louvre',
                'source' => $token
            ]);

            return $charge;
        } catch (Card $e) {
            return false;
        }
    }
}