<?php

namespace AppBundle\Form;

use AppBundle\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', ChoiceType::class, [
                'label' => 'booking.type',
                'choices' => [
                    'booking.day' => Booking::DAY,
                    'booking.half_day' => Booking::HALF_DAY]])

                ->add('dateOfVisit', DateType::class, [
                    'label' => 'booking.dateOfVisit',
                    'widget' => 'single_text'])

                ->add('nbTickets', ChoiceType::class, [
                    'label' => 'booking.nbTickets',
                    'choices' => array_combine(range(Booking::NB_TICKET_MINIMUM, Booking::NB_TICKET_MAXIMUM), range(Booking::NB_TICKET_MINIMUM, Booking::NB_TICKET_MAXIMUM))])
                ->add('email', RepeatedType::class, [
                    'type' => EmailType::class,
                    'invalid_message' => 'booking.email_error',
                    'required' => true,
                    'first_options' => ['label' => 'booking.email'],
                    'second_options' => ['label' => 'booking.repeat_mail']]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Booking::class,
            'validation_groups' => ['bookingStep']
        ));
    }

}
