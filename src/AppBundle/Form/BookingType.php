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
                'label' => 'Type de billet',
                'choices' => [
                    'Journée' => Booking::DAY,
                    'Demi-journée' => Booking::HALF_DAY]])

                ->add('dateOfVisit', DateType::class, [
                    'label' => 'Date de réservation',
                    'widget' => 'single_text'])

                ->add('nbTickets', ChoiceType::class, [
                    'label' => 'Nombre de billets',
                    'choices' => array_combine(range(Booking::NB_TICKET_MINIMUM, Booking::NB_TICKET_MAXIMUM), range(Booking::NB_TICKET_MINIMUM, Booking::NB_TICKET_MAXIMUM))])
                ->add('email', RepeatedType::class, [
                    'type' => EmailType::class,
                    'invalid_message' => 'Les deux adresses mail ne correspond pas',
                    'required' => true,
                    'first_options' => ['label' => 'Adresse mail'],
                    'second_options' => ['label' => 'Veuillez saisir à nouveau votre adresse mail']]);
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
