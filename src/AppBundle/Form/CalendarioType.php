<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CalendarioType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('fecha', DateType::class, array(
          'widget' => 'single_text',
          'label' => 'Fecha'
        ))
        ->add('turno', ChoiceType::class, array(
          'choices' => array(
            'Manaña' => 0,
            'Tarde' => 1
          ),
          'label' => 'Turno'
        ))
        ->add('colectivo', EntityType::class, array (
            'class' => 'AppBundle:Colectivos',
            'label' => 'Colectivo'
            )
        )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Calendario'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_calendario';
    }


}
