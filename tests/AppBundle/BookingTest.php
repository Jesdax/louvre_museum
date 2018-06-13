<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 03/06/18
 * Time: 21:56
 */

namespace Tests\AppBundle;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookingTest extends WebTestCase
{

    public function testBookingStep()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fr/');

        $form = $crawler->selectButton('index_validation')->form();
        $form['booking[dateOfVisit]'] = '2018-06-14'; // Date change for valid test, put date >= today
        $form['booking[type]'] = 0;
        $form['booking[nbTickets]'] = 3;
        $form['booking[email]'] = ['first' => 'augustin.kavera@outlook.fr', 'second' => 'augustin.kavera@outlook.fr'];
        $crawler = $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirect()); // check that the response is a redirect to any url

        $crawler = $client->followRedirect();

        $this->assertCount(0, $crawler->filter('#tickets_tickets > div'));

        $ticketForm = $crawler->selectButton('ticket_validation')->form();
        $ticketForm['tickets[tickets][0][lastname]'] = 'Kavera';
        $ticketForm['tickets[tickets][0][firstname]'] = 'Augustin';
        $ticketForm['tickets[tickets][0][dateOfBirth]'] = '1991-03-08';
        $ticketForm['tickets[tickets][0][country]'] = 'FR';
        $ticketForm['tickets[tickets][0][reducedPrice]'] = '1';

        $ticketForm['tickets[tickets][1][lastname]'] = 'Patault';
        $ticketForm['tickets[tickets][1][firstname]'] = 'Alexia';
        $ticketForm['tickets[tickets][1][dateOfBirth]'] = '1990-11-14';
        $ticketForm['tickets[tickets][1][country]'] = 'FR';
        $ticketForm['tickets[tickets][1][reducedPrice]'] = '1';

        $ticketForm['tickets[tickets][2][lastname]'] = 'Kavera';
        $ticketForm['tickets[tickets][2][firstname]'] = 'Ohana';
        $ticketForm['tickets[tickets][2][dateOfBirth]'] = '2017-07-30';
        $ticketForm['tickets[tickets][2][country]'] = 'FR';

        $crawler = $client->submit($ticketForm);

        $this->assertTrue($client->getResponse()->isRedirect());

        $crawler = $client->followRedirect();

        $this->assertCount(18, $crawler->filter('td'));


    }

}