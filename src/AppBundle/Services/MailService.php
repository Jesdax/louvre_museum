<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 16/05/18
 * Time: 11:11
 */

namespace AppBundle\Services;


class MailService
{

    private $email;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->email = $mailer;
    }

    public function sendMail()
    {
        $testEmail = 'augustin_kave_08@outlook.fr';

        $message = (new \Swift_Message())
            ->setFrom('augustin.kavera@gmail.com')
            ->setTo($testEmail)
            ->setSubject('Votre e-billet pour l\'entrée du musée du Louvre');

        $message->setBody(
            '<hmtl>' .
            '<body>' .
            ' Mail test de la commande test' .
            '</body>' .
            '</hmtl>',
            'text/html', 'UTF-8'
        );

        $this->email->send($message);
    }

}