<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     * Assert\Type("integer")
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var int
     * Assert\Type("bool", groups={"ticketStep"})
     * @ORM\Column(name="reducedPrice", type="integer")
     */
    private $reducedPrice;

    /**
     * @var string
     * @Assert\Length(min=2, minMessage="* 2 caractères minimum")
     * @Assert\NotBlank(groups={"ticketStep"})
     * @Assert\NotNull(groups={"ticketStep"})
     * @Assert\Type("string", groups={"ticketStep"})
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     * @Assert\Length(min=2, minMessage="* 2 caractères minimum")
     * @Assert\NotBlank(groups={"ticketStep"})
     * @Assert\NotNull(groups={"ticketStep"})
     * @Assert\Type("string", groups={"ticketStep"})
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message="* format jj/mm/aaa", groups={"ticketStep"})
     * @Assert\NotNull(groups={"ticketStep"})
     * @Assert\Date(groups={"ticketStep"})
     * @Assert\LessThanOrEqual("today", groups={"ticketStep"})
     * @ORM\Column(name="dateOfBirth", type="datetime")
     */
    private $dateOfBirth;

    /**
     * @var int
     * @Assert\Type("integer")
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     * @Assert\Country(message="* Veuillez choisir un pays dans la liste déroulante")
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Booking", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Ticket
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set reducedPrice
     *
     * @param integer $reducedPrice
     *
     * @return Ticket
     */
    public function setReducedPrice($reducedPrice)
    {
        $this->reducedPrice = $reducedPrice;

        return $this;
    }

    /**
     * Get reducedPrice
     *
     * @return int
     */
    public function getReducedPrice()
    {
        return $this->reducedPrice;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Ticket
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Ticket
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set dateOfBirth
     *
     * @param \DateTime $dateOfBirth
     *
     * @return Ticket
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    /**
     * Get dateOfBirth
     *
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Set age
     *
     * @param integer $age
     *
     * @return Ticket
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Ticket
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set booking
     *
     * @param \AppBundle\Entity\Booking $booking
     *
     * @return Ticket
     */
    public function setBooking(\AppBundle\Entity\Booking $booking)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \AppBundle\Entity\Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }
}
