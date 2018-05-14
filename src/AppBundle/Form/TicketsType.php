<?php
/**
 * Created by PhpStorm.
 * User: jesda
 * Date: 14/05/18
 * Time: 09:43
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class TicketsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('tickets', CollectionType::class, ['entry_type'=> TicketType::class, 'entry_options' => ['label' => false]]);
    }

}